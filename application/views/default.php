<div id="content" class="cf">
    <section class="home-blocks cf">
		<div class="about-project">	
			<?php if(isset($menuObj->text) && !empty($menuObj->text)){				
				echo $menuObj->text;
			}?>
		</div>
        <?php 
			$current_date = time();
			if (isset($nearest_live_event) && !empty($nearest_live_event) && $current_date <= strtotime($nearest_live_event->end_date)):?>
            <div class="upcoming-event">
				<?php 
					
					$event_start_date	= strtotime($nearest_live_event->start_date); 
					$event_end_date 	= strtotime($nearest_live_event->end_date);					
				?>
							
							<h2><?= $labels->upcoming_live_event ?></h2>
							<article>
								<img alt="" title="" src="/uploads/live_events/<?= isset($nearest_live_event->img) ? $nearest_live_event->img : '' ?>"   height="85" width="85"/>

								<h3><?= isset($nearest_live_event->title) ? $nearest_live_event->title : '' ?></h3>
								<h1><?= isset($nearest_live_event->person_name) ? $nearest_live_event->person_name : '' ?></h1>
								<h2><?= isset($nearest_live_event->person_position) ? $nearest_live_event->person_position : '' ?>
									<br/><?= isset($nearest_live_event->country) ? $nearest_live_event->country : '' ?></h2>
								<br/>
								<div class="ac clear"></div>
								<div>
									<?= isset($nearest_live_event->text) ? $nearest_live_event->text : '' ?>
								</div>
							</article>
							<span><?= isset($nearest_live_event->start_date) ?  $nearest_live_event->start_date : '' ?></span>
							<?php 												
								$event_start_date_str	= strtotime($nearest_live_event->start_date); 
								$event_end_date_str 	= strtotime($nearest_live_event->end_date);
							
							if($current_date >= $event_start_date_str &&  $current_date <= $event_end_date_str ){ ?>
								<a href="/live-events/login.php?liveEvent=<?php echo $nearest_live_event->id; ?>&lang=<?php echo $this->_lang; ?>" class="enter_live_event_chat"><?=$labels->enter_chat ?></a>
							<?php	
								}else{ 
									if ($this->session->userdata('member') && isset($joined_user) && !empty($joined_user)) { ?>
										<div class="join-event" id="">
											<div class="error-msg-green">
												<?= $labels->allready_joined ?>
											</div>
										</div>
									<?php } else { ?>
										<div class="join-event" id="join-event"><input type="submit" name="" value="<?=$labels->join_event ?>"/></div>
									<?php }
							} ?>
            </div>
        <?php else: ?>		
			<h2><? if(isset($no_event->title) && !empty($no_event->title)) { echo $no_event->title; } ?></h2>
			<article>
			<? if(isset($no_event->text) && !empty($no_event->text)) { echo $no_event->text; } ?>
			</article>		
        <?php endif; ?>   
    </section>
<?php if(isset($homeEvents) && !empty($homeEvents)) { ?>
		<div id="lateast-news" class="tab_inner show  cf">
			<h2><?php echo $labels->comp_news; ?></h2>
			
			<?php $a = 0;
			
				foreach($homeEvents as $homeEventsItem) { 
				?>
				<article <?php if($a == 0) { ?> class="marginleft-0" <?php } ?>>
						
						<em><?=$homeEventsItem->date_publish;?></em>
						<a href="/<?php echo $this->_lang; ?>/<?= $homeEventsItem->type_url?>/<?= $homeEventsItem->category_url?>/show/<?php echo $homeEventsItem->id; ?>/0">
							<strong><?= $homeEventsItem->title ?></strong>
						</a>	
						<?php echo $homeEventsItem->short; ?>
						<a class='read-more' href="/<?php echo $this->_lang; ?>/<?= $homeEventsItem->type_url?>/<?= $homeEventsItem->category_url?>/show/<?php echo $homeEventsItem->id; ?>/0" title="<?= $labels->read_more ?>"><?= $labels->read_more ?></a>
					
					<div class='clear'></div>
				</article>
			<?php $a++; } ?>			
		</div>			
	<?php } ?>
</div><!-- #content -->

<div id="right" class="cf">
	<aside>
		<h3><?= $labels->annual_reports ?></h3>
		<? if(isset($reportsList) && !empty($reportsList)){ ?>
		<div class="select-block">
			<select name="speedC" id="speedC" class="reportlist">
				<? foreach($reportsList as $report){ ?>
					<option value="<?= $report->id ?>"><?= $report->title ?></option>
				<? } ?>
			</select>
		</div>
		<input type="submit" name="" value="<?=$labels->download ?>" class="dwreport"/>
		<? } ?>
		<p>
			<br/>
			<?= $labels->reports_are_available ?>
			<br/>
		</p>
		<a href="http://get.adobe.com/reader/" target="_blank" class="down-adobe"><img alt="Get ADOBE Reader" title="Get ADOBE Reader" src="/images/adobe.png"/></a>
	</aside>
	
	<? 
	if(isset($xml) && !empty($xml)){?>
	<aside>
		<a href="https://americanspaces.state.gov/drupal6/" target="_blank"><img alt="American Spaces" title="American Spaces" src="/images/american-spaces.png"/></a>
		<br/>
		<br/>
		<?php 
		$i = 0; 		
		foreach ($xml as $xml_item) { 
			if($i > 1){
				break;	
			}
			?>
		<article>
			<h1><a href="<?= $xml_item['link'] ?>" target="_blank"><?= $xml_item['title'] ?></a></h1>
			<p>
				<?= $xml_item['date'] ?>
				<br>
				<?= $xml_item['description'] ?>
			</p>
		</article>
		<?
		
		$i++; 
		} ?>
	</aside>
	<? } ?>
</div><!-- #right-->