<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
        <i class="ph-house"></i>
        <span>Dashboard</span>
    </a>
</li>
@can('banks-list')
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('banks*') ? 'active' : ''}}" href="{{ route('banks.index') }}">
            <i class="ph-bank"></i>
            <span>Banks</span>
        </a>
    </li>
@endcan
@can('banks-list')
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('measurment-units*') ? 'active' : ''}}"
           href="{{ route('measurment-units.index') }}">
            <i class="ph-calculator"></i>
            <span>Measurment Units</span>
        </a>
    </li>
@endcan
@can('shops-list')
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('shops*') ? 'active' : ''}}" href="{{ route('shops.index') }}">
            <i class="ph-storefront"></i>
            <span>Shops</span>
        </a>
    </li>
@endcan
@canany(['purchaseItems-list','saleItems-list'])
    <li class="nav-item nav-item-submenu {{ request()->is('item*') ? 'nav-item-open' : ''}}">
        <a href="#" class="nav-link">
            <i class="ph-article"></i>
            <span>Item</span>
        </a>
        <ul class="nav-group-sub collapse {{ request()->is('admin/item*') ? 'show' : ''}}">
            @can('purchaseItems-list')
                <li class="nav-item">
                    <a
                        href="{{ route('purchase-items.index') }}"
                        class="nav-link {{ request()->routeIs('purchase-items*') ? 'active' : ''}}">
                        Purchase
                    </a>
                </li>
            @endcan
            @can('saleItems-list')
                <li class="nav-item">
                    <a
                        href="{{ route('sale-items.index') }}"
                        class="nav-link {{ request()->routeIs('sale-items*') ? 'active' : ''}}">
                        Sale
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['purchaseStocks-list','saleStocks-list'])
    <li class="nav-item nav-item-submenu {{ request()->is('admin/stock*') ? 'nav-item-open' : ''}}">
        <a href="#" class="nav-link">
            <i class="ph-article"></i>
            <span>Stock</span>
        </a>
        <ul class="nav-group-sub collapse {{ request()->is('admin/stock*') ? 'show' : ''}}">
            @can('purchaseStocks-list')
                <li class="nav-item">
                    <a
                        href="{{ route('purchase-stocks.index') }}"
                        class="nav-link {{ request()->routeIs('purchase-stocks*') ? 'active' : ''}}">
                        Purchase
                    </a>
                </li>
            @endcan
            @can('saleStocks-list')
                <li class="nav-item">
                    <a
                        href="{{ route('sale-stocks.index') }}"
                        class="nav-link {{ request()->routeIs('sale-stocks*') ? 'active' : ''}}">
                        Sale
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['vendors-list','bills-list','purchasePayments'])
    <li class="nav-item nav-item-submenu {{ request()->is('admin/purchasing*') ? 'nav-item-open' : ''}}">
        <a href="#" class="nav-link">
            <i class="ph-shopping-bag-open"></i>
            <span>Purchasing</span>
        </a>
        <ul class="nav-group-sub collapse {{ request()->is('admin/purchasing*') ? 'show' : ''}}">
            @can('vendors-list')
                <li class="nav-item">
                    <a
                        href="{{ route('vendors.index') }}"
                        class="nav-link {{ request()->routeIs('vendors*') ? 'active' : ''}}">
                        Vendors
                    </a>
                </li>
            @endcan
            @can('bills-list')
                <li class="nav-item">
                    <a
                        href="{{ route('bills.index') }}"
                        class="nav-link {{ request()->routeIs('bills*') ? 'active' : ''}}">
                        Bills
                    </a>
                </li>
            @endcan
            @can('purchasePayments-list')
                <li class="nav-item">
                    <a
                        href="{{ route('purchase-payments.index') }}"
                        class="nav-link {{ request()->routeIs('purchase-payments*') ? 'active' : ''}}">
                        Payments
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['customers-list','invoices-list','salePayments-list'])
    <li class="nav-item nav-item-submenu {{ request()->is('admin/selling*') ? 'nav-item-open' : ''}}">
        <a href="#" class="nav-link">
            <i class="ph-shopping-bag-open"></i>
            <span>Selling</span>
        </a>
        <ul class="nav-group-sub collapse {{ request()->is('admin/selling*') ? 'show' : ''}}">
            @can('customers-list')
                <li class="nav-item">
                    <a
                        href="{{ route('customers.index') }}"
                        class="nav-link {{ request()->routeIs('customers*') ? 'active' : ''}}">
                        Customers
                    </a>
                </li>
            @endcan
            @can('invoices-list')
                <li class="nav-item">
                    <a
                        href="{{ route('invoices.index') }}"
                        class="nav-link {{ request()->routeIs('invoices*') ? 'active' : ''}}">
                        Invoices
                    </a>
                </li>
            @endcan
            @can('salePayments-list')
                <li class="nav-item">
                    <a
                        href="{{ route('sale-payments.index') }}"
                        class="nav-link {{ request()->routeIs('sale-payments*') ? 'active' : ''}}">
                        Payments
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['workers-list','orders-list','productionPayments-list'])
    <li class="nav-item nav-item-submenu {{ request()->is('admin/production*') ? 'nav-item-open' : ''}}">
        <a href="#" class="nav-link">
            <i class="ph-shopping-bag-open"></i>
            <span>Production</span>
        </a>
        <ul class="nav-group-sub collapse {{ request()->is('admin/production*') ? 'show' : ''}}">
            @can('workers-list')
                <li class="nav-item">
                    <a
                        href="{{ route('workers.index') }}"
                        class="nav-link {{ request()->routeIs('workers*') ? 'active' : ''}}">
                        Workers
                    </a>
                </li>
            @endcan
            @can('recipeNames-list')
                <li class="nav-item">
                    <a
                        href="{{ route('recipe-names.index') }}"
                        class="nav-link {{ request()->routeIs('recipe-names*') ? 'active' : ''}}">
                        Recipe Names
                    </a>
                </li>
            @endcan            @can('recipes-list')
                <li class="nav-item">
                    <a
                        href="{{ route('recipes.index') }}"
                        class="nav-link {{ request()->routeIs('recipes*') ? 'active' : ''}}">
                        Recipe
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['accounts-list','transfers-list','transactions-list'])
    <li class="nav-item nav-item-submenu {{ request()->is('admin/banking*') ? 'nav-item-open' : ''}}">
        <a href="#" class="nav-link">
            <i class="ph-bank"></i>
            <span>Banking</span>
        </a>
        <ul class="nav-group-sub collapse {{ request()->is('admin/banking*') ? 'show' : ''}}">
            @can('accounts-list')
                <li class="nav-item">
                    <a
                        href="{{ route('accounts.index') }}"
                        class="nav-link {{ request()->routeIs('accounts*') ? 'active' : ''}}">
                        Accounts
                    </a>
                </li>
            @endcan
            @can('transfers-list')
                <li class="nav-item">
                    <a
                        href="{{ route('transfers.index') }}"
                        class="nav-link {{ request()->routeIs('transfers*') ? 'active' : ''}}">
                        Transfers
                    </a>
                </li>
            @endcan
            @can('transactions-list')
                <li class="nav-item">
                    <a
                        href="{{ route('transactions.index') }}"
                        class="nav-link {{ request()->routeIs('transactions*') ? 'active' : ''}}">
                        Transactions
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
@canany(['users-list','roles-list','notifications-list','audits-list','logs-list','settings-list'])
    <li class="nav-item nav-item-submenu {{ request()->is('admin/configuration*') ? 'nav-item-open' : ''}}">
        <a href="#" class="nav-link">
            <i class="ph-gear"></i>
            <span>Configuration</span>
        </a>
        <ul class="nav-group-sub collapse {{ request()->is('admin/configuration*') ? 'show' : ''}}">
            @can('users-list')
                <li class="nav-item">
                    <a
                        href="{{ route('users.index') }}"
                        class="nav-link {{ request()->routeIs('users*') ? 'active' : ''}}">
                        Users
                    </a>
                </li>
            @endcan
            @can('roles-list')
                <li class="nav-item">
                    <a
                        href="{{ route('roles.index') }}"
                        class="nav-link {{ request()->routeIs('roles*') ? 'active' : ''}}">
                        Roles
                    </a>
                </li>
            @endcan
            @can('notifications-list')
                <li class="nav-item">
                    <a
                        href="{{ route('notifications.index') }}"
                        class="nav-link {{ request()->routeIs('notifications*') ? 'active' : ''}}">
                        Notifications
                    </a>
                </li>
            @endcan
            @can('audits-list')
                <li class="nav-item">
                    <a
                        href="{{ route('audits.index') }}"
                        class="nav-link {{ request()->routeIs('audits*') ? 'active' : ''}}">
                        Audit
                    </a>
                </li>
            @endcan
            @can('logs-list')
                <li class="nav-item">
                    <a
                        href="{{ route('logs') }}" target="_blank"
                        class="nav-link {{ request()->routeIs('logs*') ? 'active' : ''}}">
                        Errors
                    </a>
                </li>
            @endcan
            @can('settings-list')
                <li class="nav-item">
                    <a
                        href="{{ route('settings.index') }}"
                        class="nav-link {{ request()->routeIs('settings*') ? 'active' : ''}}">
                        Settings
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
