
<!-- Page Content -->
<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
            </li>
            <li class="active">Clients</li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->
    <!-- Page Header -->
    <div class="page-header position-relative">
        <div class="header-title">
            <h1>
                Clients
            </h1>
        </div>
    </div>
    <!-- /Page Header -->
    <!-- Page Body -->
    <div class="page-body">

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="widget">
                    <div class="widget-header  with-footer">
                        <span class="widget-caption">Client List</span>
                        <div class="widget-buttons">
                            <a href="#" data-toggle="maximize">
                                <i class="fa fa-expand"></i>
                            </a>
                            <a href="#" data-toggle="collapse">
                                <i class="fa fa-minus"></i>
                            </a>
                            <a href="#" data-toggle="dispose">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <span class="input-icon inverted">
                                    <input type="text" class="form-control input-sm">
                                    <i class="glyphicon glyphicon-search bg-blue"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flip-scroll">
                            <table class="table table-striped table-condensed flip-content">
                                <thead class="flip-content bordered-palegreen">
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            No.of Visits
                                        </th>
                                        <th class="numeric">
                                            Start Date
                                        </th>
                                        <th class="numeric">
                                            Rating (Out of 5)
                                        </th>
                                        <th class="numeric">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? if($item!==false):?>
                                    <?php $cnt=1;?>
                                        <?foreach ($item as $key=>$value):?>
                                            <tr>
                                                <td><?=$cnt;?></td>
                                                <td><a href="<?= admin_url('client/1') ?>"><?=$value->first_name?> <?=$value->last_name?></a></td>
                                                <td>0</td>
                                                <td class="numeric">
                                                    <?= date_format(date_create($value->registered_at), "d-M-y")?>
                                                </td>
                                                <td class="numeric">
                                                    -
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-info btn-sm"><i class="fa fa-power-off"></i></a>
                                                </td>
                                            </tr>
                                            <?php $cnt++;?>
                                        <?endforeach?>
                                        <?else:?>
                                        <tr><td colspan="7" align="center">No Record Found!</td></tr>
                                    <?endif?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Body -->
</div>


<!--Google Analytics::Demo Only-->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'http://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-52103994-1', 'auto');
    ga('send', 'pageview');

</script>
