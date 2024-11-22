<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
     integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      {{--  sweet alert --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
    function toast(msg, type = 'success') {
         const Toast = Swal.mixin({
             toast: true,
             position: "top-end",
             showConfirmButton: false,
             timer: 5000,
             timerProgressBar: true,
             didOpen: (toast) => {
                 toast.onmouseenter = Swal.stopTimer;
                 toast.onmouseleave = Swal.resumeTimer;
             }
         });
         Toast.fire({
             icon: type,
             title: msg
         });
     }

     @if (Session::has('success'))
         toast("{{ Session::get('success') }}", 'success');
     @elseif (Session::has('error'))
         toast("{{ Session::get('error') }}", 'error');
     @elseif (Session::has('info'))
         toast("{{ Session::get('info') }}", 'info');
     @elseif (Session::has('warning'))
         toast("{{ Session::get('warning') }}", 'warning');
     @endif
 </script>