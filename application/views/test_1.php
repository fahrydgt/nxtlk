 
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/itemslide_slick/slick.css');?>"> 
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/itemslide_slick/slick-theme.css');?>"> 
  <!--<link rel="stylesheet" href="<?php // echo base_url('templates/plugins/itemslide_flickity/css/flickity.css');?>">--> 
      
  
  <section class="lazy slider" data-sizes="50vw">
   
    <div>
        <p>aaaaaaaaaaaa</p>
    </div>
    <div>
        <p>aaaaaaaaaaaa</p>
    </div> 
  </section>
<!--<script src="<?php // echo base_url('templates/plugins/JQuery/jquery-2.2.0.min.js')?>"></script>--> 
<script src="<?php echo base_url('templates/plugins/jQuery/jquery-2.2.0.min.js');?>"></script>
<script src="<?php echo base_url('templates/plugins/itemslide_slick/slick.js')?>"></script> 
<!--<script src="<?php // echo base_url('templates/plugins/itemslide_flickity/js/flickity-docs.min.js')?>"></script>--> 

  <script type="text/javascript">
    $(document).on('ready', function() { 
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: false
      });
    });
</script>