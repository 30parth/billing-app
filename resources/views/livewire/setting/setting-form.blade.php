<div class="p-6 max-w-5xl mx-auto space-y-6">
    <!-- Header Page Title -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-default-medium pb-4">
        <div>
            <h1 class="text-2xl font-bold text-heading">Print & System Settings</h1>
            <p class="text-sm text-body mt-1">Configure your company profile, bank account details, and custom fonts for invoice PDF prints.</p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-fg-success bg-success-soft border border-success-subtle rounded-base flex items-center justify-between" role="alert">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-success" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-fg-danger bg-danger-soft border border-danger-subtle rounded-base flex items-center justify-between" role="alert">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-danger" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        
        <!-- CARD 1: Seller / Company Details -->
        <x-ui.card title="Company Details">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.form.input-with-label name="company_name" label="Company / Seller Name" placeholder="e.g. Bharat Vara" />
                <x-ui.form.input-with-label name="company_gstin" label="GSTIN / Tax Identification No" placeholder="e.g. 24ABCDE1234F1Z5" />
                
                <x-ui.form.input-with-label name="company_phone" label="Contact Number" placeholder="e.g. +91 98765 43210" />
                <x-ui.form.input-with-label name="company_email" label="Email Address" type="email" placeholder="e.g. billing@company.com" />
                
                <div class="md:col-span-2">
                    <label for="company_address" class="block mb-2.5 text-sm font-medium text-heading">Company Address (Will be shown in PDF)</label>
                    <textarea id="company_address" wire:model="company_address"
                        class="border text-sm rounded-base block w-full px-3 py-2.5 shadow-xs placeholder:text-body bg-neutral-secondary-medium border-default-medium text-heading focus:ring-brand focus:border-brand"
                        rows="3" placeholder="Address, City, State, ZIP"></textarea>
                    @error('company_address')
                        <span class="text-sm text-fg-danger-strong">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </x-ui.card>

        <!-- CARD 2: Bank Details -->
        <x-ui.card title="Bank Information (Shown on invoice for payment)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.form.input-with-label name="account_holder" label="Account Holder Name" placeholder="e.g. Bharat Vara" />
                <x-ui.form.input-with-label name="bank_name" label="Bank Name" placeholder="e.g. State Bank of India" />
                
                <x-ui.form.input-with-label name="account_no" label="Account Number" placeholder="e.g. 123456789012" />
                <x-ui.form.input-with-label name="ifsc_code" label="IFSC Code" placeholder="e.g. SBIN0001234" />
                
                <div class="md:col-span-2">
                    <x-ui.form.input-with-label name="bank_branch" label="Branch Name" placeholder="e.g. Rajkot Main Branch" />
                </div>
            </div>
        </x-ui.card>

        <!-- CARD 3: Custom QR Code & Typography (Gujarati Font) -->
        <x-ui.card title="Custom Media & Typography Settings">
            <div class="grid grid-cols-1  gap-8">
                <!-- QR Code Upload -->
                <div class="space-y-4">
                    <label class="block text-sm font-bold text-heading">Payment QR Code</label>
                    <p class="text-xs text-body">Upload a PNG or JPG QR Code of your UPI or payment address. Displays at the bottom right of the PDF invoice.</p>
                    
                    @if ($current_qr_code_path)
                        <div class="flex items-center space-x-4 p-3 bg-neutral-secondary-soft rounded-base border border-default">
                            <img src="{{ Storage::url($current_qr_code_path) }}" alt="QR Code Preview" class="w-16 h-16 object-contain border border-default rounded bg-white">
                            <div>
                                <span class="text-xs font-semibold text-heading block">Current QR Code Image</span>
                                <button type="button" wire:click="deleteQrCode" class="mt-1 text-xs text-fg-danger-strong hover:underline flex items-center space-x-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-center w-full">
                        <label for="qr-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-default-medium rounded-base cursor-pointer bg-neutral-secondary-medium hover:bg-neutral-secondary-soft transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-body" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                                <p class="mb-1 text-xs text-heading"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-[10px] text-body">PNG, JPG or JPEG (Max. 2MB)</p>
                            </div>
                            <input id="qr-upload" type="file" wire:model="qr_code" class="hidden" accept="image/*" />
                        </label>
                    </div>
                    @error('qr_code')
                        <span class="text-sm text-fg-danger-strong">{{ $message }}</span>
                    @enderror

                    <!-- QR code upload state -->
                    <div wire:loading wire:target="qr_code" class="text-xs text-brand">Uploading QR Code...</div>
                    @if ($qr_code)
                        <div class="text-xs text-success">New QR Code selected: {{ $qr_code->getClientOriginalName() }}</div>
                    @endif
                </div>
            </div>
        </x-ui.card>

        <!-- Save Button Bar -->
        <div class="flex justify-end pt-4 border-t border-default-medium">
            <x-ui.button type="submit" variant="primary" size="lg" class="px-6 py-2.5">
                <span class="font-bold">Save Settings</span>
            </x-ui.button>
        </div>

    </form>
</div>
