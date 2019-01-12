<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
<?php 
    $query = "SELECT * FROM themes where id = '1'";
    $result = $db->select($query);
    if($result){
        while($theme = $result->fetch_assoc()){
            ?>
        <link rel="stylesheet" href="theme/<?php echo $theme['theme'];?>.css">
    <?php } }?>