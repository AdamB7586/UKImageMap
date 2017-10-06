<?php
    require 'vendor/autoload.php';
    
    $database = new DBAL\Database('localhost', 'root', '', 'uk_map');
    $map = new UKMap\Map($database);
    
    $regions = $map->getRegions();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UK Map</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="/css/map.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <img src="/images/areas.jpg" alt="Uk Postcode" width="500" height="892" class="img-responsive center-block ukimage" usemap="#uk-postcodes" />
                </div>
                <div class="col-sm-6">
                    <div id="links">
                        <?php
                            foreach($regions as $region){
                                echo('<a href="region.php?region='.$region['url'].'" title="'.$region['name'].'" data-area="'.$region['url'].'" id="link-'.$region['url'].'">'.$region['name'].'</a><br />');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <map name="uk-postcodes">
            <?php
                foreach($regions as $region){
                    echo('<area shape="poly" coords="'.$region['imagemap'].'" href="region.php?region='.$region['url'].'" alt="'.$region['name'].'" title="'.$region['name'].'" data-area="'.$region['url'].'" id="area-'.$region['url'].'" />');
                }
            ?>
        </map>
        <script src="/js/jquery.js" type="text/javascript"></script>
        <script src="/js/uk-map.min.js" type="text/javascript"></script>
    </body>
</html>
