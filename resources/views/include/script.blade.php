<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script type="text/javascript" src="{{asset('front/assets/js/datatables.min.js')}}"></script>
<script src="{{ asset('all.js') }}"></script>
<script src="{{ asset('plugins/toaltr/toaltr.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
@if(Session::has('success') || Session::has('info'))
{{ view_html(Toastr::message()) }}
@endif
<!-- Stack array for including inline js or scripts -->
@stack('script')
<script src="{{ asset('dist/js/theme.js') }}"></script>
<script src="{{asset('js/live-img.js')}}"></script>
<script src="{{asset('js/time.js')}}"></script>
<script src="{{ asset('js/main.js') }}"></script>
