<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom:32px;">
    <li class="nav-item">
        <a class="nav-link @if($tab == 'noting-charge') active @endif"  href="{{url('admin/data-entry/noting-charge')}}" >Noting Charge</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'certified-copy') active @endif" href="{{url('admin/data-entry/certified-copy')}}" >Certified Copy</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'workstation-mutation') active @endif" href="{{url('admin/data-entry/workstation-mutation')}}">Mutation</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'sale-deed') active @endif"  href="{{url('admin/data-entry/sale-deed')}}" >Sale Deed</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if($tab == 'bt-transaction') active @endif" href="{{url('admin/data-entry/bt-transaction')}}" >BT Transaction</a>
    </li>
</ul>