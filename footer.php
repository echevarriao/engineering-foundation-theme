    <?php if(!is_front_page()): ?>
        </div>
    </div>
    <?php endif; ?>
    </div>
    <div class = "long-row gray-gradient" id = "sitemap">
<?php if(is_active_sidebar('footer-sitemap')){ ?>
        <div class = "row">
            <div class = "large-14 columns">
                <ul class = "small-block-grid-2 medium-block-grid-4 large-block-grid-8" id = "footer-sitemap">
<?php dynamic_sidebar('footer-sitemap'); ?>
                </ul>
            </div>
        </div>
<?php } else { ?>
<?php } ?>        
    </div>
    <div class = "long-row">
        <div class = "row">
<?php if(is_active_sidebar('footer-address-area')){ ?>
            <div class = "large-14 columns">
<?php dynamic_sidebar('footer-address-area'); ?>
            </div>
<?php } else { ?>
<div class = "large-7 left columns">
    <p>&copy; University of Connecticut | <a href="http://www.uconn.edu/azindex.php"> A-Z Index</a> | <a href="http://www.uconn.edu/">UConn Web</a> | <a href="http://uconn.edu/disclaimers-and-copyrights.php">Disclaimers, Privacy &amp; Copyright</a> | <a href="http://audit.uconn.edu/arra.htm">Recovery Act/Stimulus Information</a></p>
</div>
<div class = "large-7 right columns">
    <p>(860)486-2221|School of Engineering - 261 Glenbrook Road, Connecticut0 6268-3237</p>
</div>
<?php } ?>
        </div>
    </div>
</div>
<script language = "javascript" type = "text/javascript">
    
    $(document).ready(function(){
        
        $(document).foundation();
        
    });
    
        
</script>
<?php wp_footer(); ?>
</body>
</html>