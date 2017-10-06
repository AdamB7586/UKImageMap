<?php
    require 'vendor/autoload.php';
    
    $database = new DBAL\Database('localhost', 'root', '', 'uk_map');
    $map = new UKMap\Map($database);
    
    $region = $_GET['region'];
    
    $areas = $map->getRegionPostcodes($region);
    $info = $map->getRegionInfo($region)
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
                <div class="col-xs-12">
                    <h3><?php echo($info['name']); ?></h3>
                    <p>Please select your postcode area on the map or select one from the list below.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <img src="/images/<?php echo($region); ?>.png" alt="<?php echo($info['name']); ?>" width="<?php echo($info['width']); ?>" height="<?php echo($info['height']); ?>" class="img-responsive center-block ukimage" usemap="#uk-postcodes" />
                </div>
                <div class="col-sm-6">
                    <div id="links">
                        <?php
                            foreach($areas as $postcode){
                                echo('<a href="#" title="'.$postcode['name'].'" data-area="'.$postcode['url'].'" id="link-'.$postcode['url'].'">'.$postcode['postcode'].' - '.$postcode['name'].'</a><br />');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <map name="uk-postcodes">
            <?php
                foreach($areas as $postcode){
                    echo('<area shape="poly" coords="'.$postcode['map'].'" href="'.$postcode['url'].'" alt="'.$postcode['name'].'" title="'.$postcode['name'].'" data-area="'.$postcode['url'].'" id="area-'.$postcode['url'].'" />');
                }
            ?>
        </map>
        <script src="/js/jquery.js" type="text/javascript"></script>
        <script src="/js/uk-map.min.js" type="text/javascript"></script>
    </body>
</html>
