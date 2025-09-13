        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="/" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src=""
              alt=""
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">CARGO CHAINS</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>


		 <!--begin::Sidebar Wrapper-->
	<div class="sidebar-wrapper">
		<a href="/" class="brand-link px-3">Admin</a>
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-lte-toggle="treeview">
			  <li class="nav-item"><?= $this->Html->link('Shipments', ['/shipments'], ['class'=>'nav-link']) ?></li>
			  <li class="nav-item"><?= $this->Html->link('Sales Quotations', ['/sales/sales-quotations'], ['class'=>'nav-link']) ?></li>
			  <li class="nav-item"><?= $this->Html->link('Sales Orders', ['/sales/sales-orders'], ['class'=>'nav-link']) ?></li>
			  <li class="nav-item"><?= $this->Html->link('Users', ['/users/users'], ['class'=>'nav-link']) ?></li>
			</ul>
		</nav>
	</div>
	