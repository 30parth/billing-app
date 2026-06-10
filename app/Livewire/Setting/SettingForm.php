<?php

namespace App\Livewire\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingForm extends Component
{
    use WithFileUploads;

    // Company Info
    public $company_name;
    public $company_address;
    public $company_phone;
    public $company_email;
    public $company_gstin;

    // Bank Details
    public $bank_name;
    public $bank_branch;
    public $account_no;
    public $ifsc_code;
    public $account_holder;

    // Print options
    public $use_gujarati_font = false;

    // Upload inputs
    public $qr_code;
    public $font_file;

    // Existing file references
    public $current_qr_code_path;
    public $current_font_path;

    protected function rules()
    {
        return [
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_gstin' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'account_no' => 'nullable|string|max:50',
            'ifsc_code' => 'nullable|string|max:20',
            'account_holder' => 'nullable|string|max:255',
            'use_gujarati_font' => 'boolean',
            'qr_code' => 'nullable|image|max:2048', // 2MB Max
            'font_file' => 'nullable|file|mimes:ttf|max:10240', // 10MB Max TTF
        ];
    }

    public function mount()
    {
        $setting = Auth::user()->setting;

        if ($setting) {
            $this->company_name = $setting->company_name;
            $this->company_address = $setting->company_address;
            $this->company_phone = $setting->company_phone;
            $this->company_email = $setting->company_email;
            $this->company_gstin = $setting->company_gstin;
            
            $this->bank_name = $setting->bank_name;
            $this->bank_branch = $setting->bank_branch;
            $this->account_no = $setting->account_no;
            $this->ifsc_code = $setting->ifsc_code;
            $this->account_holder = $setting->account_holder;
            
            $this->use_gujarati_font = (bool)$setting->use_gujarati_font;
            
            $this->current_qr_code_path = $setting->qr_code_path;
            $this->current_font_path = $setting->font_path;
        }
    }

    public function save()
    {
        $this->validate();

        $setting = Auth::user()->setting ?? new Setting();
        $setting->user_id = Auth::id();

        $setting->company_name = $this->company_name;
        $setting->company_address = $this->company_address;
        $setting->company_phone = $this->company_phone;
        $setting->company_email = $this->company_email;
        $setting->company_gstin = $this->company_gstin;

        $setting->bank_name = $this->bank_name;
        $setting->bank_branch = $this->bank_branch;
        $setting->account_no = $this->account_no;
        $setting->ifsc_code = $this->ifsc_code;
        $setting->account_holder = $this->account_holder;
        $setting->use_gujarati_font = $this->use_gujarati_font;

        // Save QR Code if uploaded
        if ($this->qr_code) {
            // Delete old QR if it exists
            if ($setting->qr_code_path) {
                Storage::disk('public')->delete($setting->qr_code_path);
            }
            $qrPath = $this->qr_code->store('qrcodes', 'public');
            $setting->qr_code_path = $qrPath;
            $this->current_qr_code_path = $qrPath;
            $this->qr_code = null;
        }

        // Save Font file if uploaded
        if ($this->font_file) {
            // Delete old font if it exists
            if ($setting->font_path) {
                Storage::disk('public')->delete($setting->font_path);
            }
            $fontPath = $this->font_file->store('fonts', 'public');
            $setting->font_path = $fontPath;
            $this->current_font_path = $fontPath;
            $this->font_file = null;
        }

        $setting->save();

        session()->flash('message', 'Settings saved successfully!');
    }

    public function downloadDefaultFont()
    {
        $fontUrl = 'https://github.com/samyakbhuta/fonts-samyak/raw/master/Samyak-Gujarati.ttf';
        $fontDir = storage_path('app/public/fonts');
        
        if (!file_exists($fontDir)) {
            mkdir($fontDir, 0755, true);
        }
        
        $fontPath = 'fonts/Samyak-Gujarati.ttf';
        $fullPath = storage_path('app/public/' . $fontPath);

        try {
            $options = [
                'http' => [
                    'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
                ]
            ];
            $context = stream_context_create($options);
            $fontContent = file_get_contents($fontUrl, false, $context);
            
            if ($fontContent) {
                file_put_contents($fullPath, $fontContent);
                
                $setting = Auth::user()->setting ?? new Setting();
                $setting->user_id = Auth::id();
                $setting->font_path = $fontPath;
                $setting->use_gujarati_font = true;
                $setting->save();

                $this->current_font_path = $fontPath;
                $this->use_gujarati_font = true;
                
                session()->flash('message', 'Default Gujarati font downloaded and configured successfully!');
            } else {
                session()->flash('error', 'Could not download the font automatically. Please upload a .ttf file manually.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error downloading font: ' . $e->getMessage());
        }
    }

    public function deleteQrCode()
    {
        $setting = Auth::user()->setting;
        if ($setting && $setting->qr_code_path) {
            Storage::disk('public')->delete($setting->qr_code_path);
            $setting->qr_code_path = null;
            $setting->save();
            $this->current_qr_code_path = null;
            session()->flash('message', 'QR Code deleted successfully.');
        }
    }

    public function deleteFont()
    {
        $setting = Auth::user()->setting;
        if ($setting && $setting->font_path) {
            Storage::disk('public')->delete($setting->font_path);
            $setting->font_path = null;
            $setting->use_gujarati_font = false;
            $setting->save();
            $this->current_font_path = null;
            $this->use_gujarati_font = false;
            session()->flash('message', 'Font file deleted.');
        }
    }

    public function render()
    {
        return view('livewire.setting.setting-form')
            ->layout('layouts.app');
    }
}
