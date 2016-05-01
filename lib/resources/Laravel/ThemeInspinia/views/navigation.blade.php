<?$user = Sentinel::findById(Auth::user()->id);?>
@if($user->hasAccess(['dashboard']))
@if(in_array('dashboard',$view))
    <li class="active">
@else
    <li>
@endif
    <a href="{{url('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
</li>
@endif
{{--_NavBar_--}}