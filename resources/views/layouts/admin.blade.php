<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - FOODY')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin-pagination.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0">
                @include('admin.sidebar')
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-0 admin-main-content">
                <!-- Header -->
                <div class="admin-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="admin-page-title">@yield('page-title', 'Dashboard')</h2>
                            </div>
                            <div class="col-auto">
                                <span class="admin-date">{{ date('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="admin-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
    <script>
        // Auto-hide success alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            
            if (successAlert) {
                setTimeout(function() {
                    const alert = new bootstrap.Alert(successAlert);
                    alert.close();
                }, 5000);
            }
            
            if (errorAlert) {
                setTimeout(function() {
                    const alert = new bootstrap.Alert(errorAlert);
                    alert.close();
                }, 8000);
            }
        });
    </script>
    @yield('scripts')
</body>
</html>