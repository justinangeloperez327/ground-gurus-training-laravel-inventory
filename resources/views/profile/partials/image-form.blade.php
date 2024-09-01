<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Image') }}
        </h2>

    </header>

    <form method="post" action="{{ route('profile.image') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf

        <div x-data="{ imagePreview: '{{ $user->image?->image_url }}' }">
            <x-input-label for="image" :value="__('Image')" />
            <x-text-input id="image" class="" type="file" @change="handleFileUpload" name="image" :value="$user->image?->image_url" autofocus accept="image/*"/>
            <img x-show="imagePreview" :src="imagePreview" alt="Image Preview" style="max-width: 300px; margin-top: 20px;">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        @section('scripts')
            <script>
                function handleFileUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.imagePreview = e.target.result
                        };
                        reader.readAsDataURL(file);
                    }
                }
            </script>
        @endsection

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
