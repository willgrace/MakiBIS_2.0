		<ol style="list-style: none;" class="tree">
			<?php
				$joinBottom = 'images/joinbottom.gif';
				$join = 'images/join.gif';
				$plusLines = 'images/pluslines.gif';
				$plusBottom = 'images/plusbottom.gif';
				$line = 'images/line.gif';
				$myquery_domain = $this->user_model->query_domain();
				foreach ($myquery_domain->result() as $row ){
					$domain = $row->domain;
					$domain_id = $row->domain_id;
					$domain_id = "d".$domain_id;
					echo '<li class="tree">';
					$image_properties = array('src' => 'images/plus.gif','class' => 'flip_domain', 'id' => $domain_id);
					echo img($image_properties).$domain;
					echo '<ol class="tree">';
					$myquery_kingdom = $this->user_model->query_kingdom($row->domain_id);
						foreach ($myquery_kingdom->result() as $row ){
						$kingdom = $row->kingdom;
						$domain_domain_id = $row->domain_domain_id;
						$domain_domain_id="d".$domain_domain_id;
						$kingdom_id = $row-> kingdom_id;
						$kingdom_id = "k".$kingdom_id;
						echo '<li class="kingdom tree" id="'.$domain_domain_id.'" style="display:none;">';
						$image_properties = array('src' => $row==$myquery_kingdom->last_row() ? $plusBottom : $plusLines,'class' => 'flip_kingdom', 'id' => $kingdom_id);
						echo img($line).img($image_properties)."<i>Kingdom </i>".$kingdom;
						echo '<ol class="tree">';
						$myquery_phylum = $this->user_model->query_phylum($row->kingdom_id);
						foreach ($myquery_phylum->result() as $row ){
							$phylum = $row->phylum;
							$kingdom_kingdom_id = $row->kingdom_kingdom_id;
							$kingdom_kingdom_id = "k".$kingdom_kingdom_id;
							$phylum_id = $row-> phylum_id;
							$phylum_id = "p".$phylum_id;
							echo '<li class="phylum tree" id="'.$kingdom_kingdom_id.'" style="display:none;">';
							$image_properties = array('src' => $row==$myquery_phylum->last_row() ? $plusBottom : $plusLines,'class' => 'flip_phylum', 'id' => $phylum_id);
							echo img($line).img($line).img($image_properties)."<i>Phylum </i>".$phylum;
							echo '<ol class="tree">';
							$myquery_class = $this->user_model->query_class($row->phylum_id);
							foreach ($myquery_class->result() as $row ){
								$class = $row->class;
								$phylum_phylum_id = $row->phylum_phylum_id;
								$phylum_phylum_id = "p".$phylum_phylum_id;
								$class_id = $row-> class_id;
								$class_id = "c".$class_id;
								echo '<li class="class tree" id="'.$phylum_phylum_id.'" style="display:none;">';
								$image_properties = array('src' => $row==$myquery_class->last_row() ? $plusBottom : $plusLines,'class' => 'flip_class', 'id' => $class_id);
								echo img($line).img($line).img($line).img($image_properties)."<i>Class </i>".$class;
								echo '<ol class="tree">';
								$myquery_order = $this->user_model->query_order($row->class_id);
								foreach ($myquery_order->result() as $row ){
									$order = $row->order_name;
									$class_class_id = $row->class_class_id;
									$class_class_id = "c".$class_class_id;
									$order_id = $row-> order_id;
									$order_id = "o".$order_id;
									echo '<li class="order tree" id="'.$class_class_id.'" style="display:none;">';
									$image_properties = array('src' => $row==$myquery_order->last_row() ? $plusBottom : $plusLines,'class' => 'flip_order', 'id' => $order_id);
									echo img($line).img($line).img($line).img($line).img($image_properties)."<i>Order </i>".$order;
									echo '<ol class="tree">';
									$myquery_family = $this->user_model->query_family_tree($row->order_id);
									foreach ($myquery_family->result() as $row ){
										$family = $row->family;
										$order_order_id = $row->table_order_order_id;
										$order_order_id = "o".$order_order_id;
										$family_id = $row-> family_id;
										$family_id = "f".$family_id;
										echo '<li class="family tree" id="'.$order_order_id.'" style="display:none;">';
										$image_properties = array('src' => $row==$myquery_family->last_row() ? $plusBottom : $plusLines,'class' => 'flip_family', 'id' => $family_id);
										echo img($line).img($line).img($line).img($line).img($line).img($image_properties)."<i>Family </i>".$family;
										echo '<ol class="tree">';
										$myquery_genus = $this->user_model->query_genus($row->family_id);
										foreach ($myquery_genus->result() as $row ){
											$genus = $row->genus;
											$family_family_id = $row->family_family_id;
											$family_family_id = "f".$family_family_id;
											$genus_id = $row-> genus_id;
											$genus_id = "g".$genus_id;
											echo '<li class="genus tree" id="'.$family_family_id.'" style="display:none;">';
											$image_properties = array('src' => $row==$myquery_genus->last_row() ? $plusBottom : $plusLines,'class' => 'flip_genus', 'id' => $genus_id);
											echo img($line).img($line).img($line).img($line).img($line).img($line).img($image_properties)."<i>Genus </i>".$genus;
											echo '<ol class="tree">';
											$myquery_species = $this->user_model->query_species($row->genus_id);
											foreach ($myquery_species->result() as $row ){
												$species = $genus." ".$row->species;
												$genus_genus_id = $row->genus_genus_id;
												$genus_genus_id = "g".$genus_genus_id;
												$id = $row-> taxon_id;
												echo '<li class="species tree" id="'.$genus_genus_id.'" style="display:none;">';
												$image_properties = array('src' => $row==$myquery_species->last_row() ? $joinBottom : $join );
												if($row->flag==1){
												echo img($line).img($line).img($line).img($line).img($line).img($line).img($line).img($image_properties).anchor('user/species_profile/'.$id,$species);
												}
												echo '</li>';
												
											}
											echo '</ol>';
											echo '</li>';
														
										}
										echo '</ol>';
										echo '</li>';
									}
									echo '</ol>';
									echo '</li>';
								}
								echo '</ol>';
								echo '</li>';
							}
							echo '</ol>';
							echo '</li>';
						}
						echo '</ol>';
						echo '</li>';
					}
					echo '</ol>';
					echo '</li>';
				}				
			?>
		</ol>