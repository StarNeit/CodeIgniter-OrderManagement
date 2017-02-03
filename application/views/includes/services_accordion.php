<div class="panel-group" id="accordion">
    <?php foreach($services as $service):?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#service<?=$service->id?>" class="accordion-toggle collapsed">
                        <img src="assets/images/<?=$service->icon?>" alt="<?=$service->service?>" class="img img-circle img-service">
                        <?=$service->service?>
                    </a>
                </h4>
            </div>
            <div id="service<?=$service->id?>" class="panel-collapse collapse">
               
                <div class="panel-body">
                    <ul>
                        <?php foreach($service->skills as $skill):?>
                            <li><a href="javascript:;"><?=$skill->skill?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach;?>               
</div>