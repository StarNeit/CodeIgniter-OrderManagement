<!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?=admin_url()?>">Home</a>
            </li>
            <li><a href="<?=admin_url("carepro")?>">CarePro</a></li>
            <li class="active"><?=($title) ? $title : $user->first_name . ' ' . $user->last_name?></li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Header -->
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>
                <?=($title) ? $title : $user->first_name . ' ' . $user->last_name?>
            </h1>
        </div>
    </div>