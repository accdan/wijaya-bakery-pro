<!-- Modern Toast Container -->
<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 60px; right: 10px; z-index: 1100; pointer-events: none;">
    <div id="toastNotification"
         class="toast shadow-lg border-0"
         role="alert"
         aria-live="assertive"
         aria-atomic="true"
         data-autohide="true"
         data-delay="4000"
         style="pointer-events: auto; width: 360px; max-width: none; backdrop-filter: blur(10px); background-color: rgba(40, 167, 69, 0.85); color: white; animation: slideIn 0.5s ease-out;">

        <div class="toast-header text-white" style="background: transparent; border-bottom: 1px solid rgba(255,255,255,0.2);">
            @if (session('success'))
                <i class="fas fa-check-circle fa-lg me-2 text-white"></i>
            @elseif (session('error'))
                <i class="fas fa-exclamation-triangle fa-lg me-2 text-white"></i>
            @endif

            <strong class="me-auto">Notifikasi</strong>
            <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>

        <div class="toast-body fs-6">
            @if (session('success'))
                {{ session('success') }}
            @elseif (session('error'))
                {{ session('error') }}
            @endif
        </div>
    </div>
</div>
<style>
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>




