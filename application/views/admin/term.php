
    
    <head>
          <meta charset="UTF-8">
          <title>Tarms</title>
         <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML,CSS,XML,JavaScript">
  <meta name="author" content="John Doe">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="<?php echo base_url()?>/css2/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url()?>/plugin2/bootstrap-3.3.7-dist/css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <section class="head">
            <div class="container">
         <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <h2>Terms and Conditions </h2>
             <?php 
					  foreach($results as $key=>$value)
					  {
					      
					      $description=$value['description'];
					       $title=$value['title'];
					  }
					  ?>
                 <p><?php echo $description ; ?></p>
                 
                 <h2><?php echo $title ; ?></h2>
                 <br>
                 <p>You are specifically restricted from all of the following:

publishing any Website material in any other media;
selling, sublicensing and/or otherwise commercializing any Website material;
publicly performing and/or showing any Website material;
using this Website in any way that is or may be damaging to this Website;
using this Website in any way that impacts user access to this Website;
using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;
engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;
using this Website to engage in any advertising or marketing.
Certain areas of this Website are restricted from being access by you and Company Name may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.</p>
             </div>
                </div>
            </div>
        
        </section>
    </body>