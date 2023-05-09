<nav class="none-printable">
    <table>
        <th>
            <tr>
                <td>
                    <ul>
                        <li><a href="/">All Listings</a></li>
                        @if(Auth::user())
                        <li><a href="/create">New Listing</a></li>
                        <li><a href="/manage">Manage Listings</a></li>
                        <li><a href="/sales">Sales Report</a></li>
                        <li>
                            <form method='POST' id='logout' action='/logout'>
                                {{ csrf_field() }}
                                <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                            </form>
                        </li>
                        <li><a href="/orders">My Orders</a></li>
                        @else
                        <li><a href="/login">Login</a></li>
                        @endif
                    </ul>
                </td>
            </tr>
        </th>
    </table>
</nav>