<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <img id="photoPreview" src="{{ auth()->user()->photo ? auth()->user()->photo : asset('backend/assets/images/avatars/avatar-2.png') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110" height="110">
                <div class="mt-3">
                    <h4 class="mb-1">{{auth()->user()->name}}</h4>
                    <p class="text-secondary mb-1">{{auth()->user()->email}}</p>
                    <p class="text-muted font-size-sm mb-0">
                        <span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span>
                    </p>
                </div>
            </div>
            <hr class="my-4" />

        </div>
    </div>
</div>
