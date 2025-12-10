    <!-- jQuery library js -->
    <script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
    <!-- Apex Chart js -->
    <script src="{{ asset('assets/js/lib/apexcharts.min.js') }}"></script>
    <!-- Data Table js -->
    <script src="{{ asset('assets/js/lib/dataTables.min.js') }}"></script>
    <!-- Iconify Font js -->
    <script src="{{ asset('assets/js/lib/iconify-icon.min.js') }}"></script>
    <!-- jQuery UI js -->
    <script src="{{ asset('assets/js/lib/jquery-ui.min.js') }}"></script>
    <!-- Vector Map js -->
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- Popup js -->
    <script src="{{ asset('assets/js/lib/magnifc-popup.min.js') }}"></script>
    <!-- Slick Slider js -->
    <script src="{{ asset('assets/js/lib/slick.min.js') }}"></script>
    <!-- prism js -->
    <script src="{{ asset('assets/js/lib/prism.js') }}"></script>
    <!-- file upload js -->
    <script src="{{ asset('assets/js/lib/file-upload.js') }}"></script>
    <!-- audioplayer -->
    <script src="{{ asset('assets/js/lib/audioplayer.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "نجاح!",
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "خطأ!",
                text: "{{ session('error') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            Swal.fire({
                icon: "warning",
                title: "تنبيه!",
                text: "{{ session('warning') }}",
                showConfirmButton: true
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            let errorMessages = `
            <ul style="text-align: right; direction: rtl;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `;

            Swal.fire({
                icon: "error",
                title: "يوجد بعض الأخطاء!",
                html: errorMessages,
                confirmButtonText: "حسناً"
            });
        </script>
    @endif
    <!-- main js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <?php echo isset($script) ? $script : ''; ?>

    <script>
        CKEDITOR.editorConfig = function(config) {
            config.versionCheck = false;
        };
    </script>
