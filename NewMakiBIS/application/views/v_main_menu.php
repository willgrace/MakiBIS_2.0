<div id="menu">
    <ul class="menu">
        <li><a href="<?php echo base_url();?>" class="parent"><span>Home</span></a>
            <div><ul>
                <li><a href="#" class=""><span>About Us</span></a>
            
                </li>
                <li><a href="#"><span>Related Links</span></a></li>
                <li><a href="#"><span>Sub Item 3</span></a></li>
            </ul></div>
        </li>
        <li><a href="#" class="parent"><span>View Species</span></a>
            <div><ul>
				<li><?php echo anchor('user/view_all_species','<span>View All Species</span>')?></li>
				<li><?php echo anchor('user/view_animalia','<span>Kingdom Animalia</span>')?></li>
				<li><?php echo anchor('user/view_plantae','<span>Kingdom Plantae</span>')?></li>
            </ul></div>
        </li>
        <li><?php echo anchor('user/taxon_tree','<span>Taxon Tree</span>')?></li>
		<li><?php echo anchor('user/view_all_reference','<span>List of Reference</span>')?></li>
        <li><a href="#"><span>News and Events</span></a></li>
        <li class="last"><?php echo anchor('user/login', '<span>Log In</span>');?></li>
    </ul>
</div>

