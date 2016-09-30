<html>
    <head>
            <title> <?php echo $title; ?> </title>
            <?php echo $css_files; ?>
            <?php echo $js_files; ?>
    </head>
        <body>

        	<div class="row"> <div class="col-xs-12 col-sm-12 col-md-12">

            <?php echo $header_section; ?>

			</div></div>
            <div class="container">
        	<div class="row"> <div class="col-xs-2 col-sm-2 col-md-2">

            <?php echo $left_section; ?>

        	</div>
        	<div class="col-xs-7 col-sm-7 col-md-7">

            <?php echo $center_section; ?>

        	</div>
        	<div class="col-xs-3 col-sm-3 col-md-3">

            <?php echo $right_section; ?>

        	</div> </div>

            </div>
        	<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">

            <?php echo $footer_section; ?>

        	</div></div>
        </body>
</html>