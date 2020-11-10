<?php

include('./_head.php'); // include header markup ?>

<div class="content blog-list">
	<section class="hero-section" style="background-image: url('<?php echo $page->get("header_image")->url; ?>'); background-position: center; background-size: cover; background-repeat: no-repeat;">
		<!-- hero-main-text -->
		<?php echo "<h1>" . $page->get('headline|title') . "</h1>"; ?>

	</section>
	<div class="wrapper">
		<section class="category-nav">
			<?php
				$currentLanguage = $lang; // remember language
				if ($currentLanguage == 'en') {
					echo "<p>" . "Categories:" . "</p>";
				} else {
					echo "<p>" . "Kategorije:" . "</p>";
				}
			?>
			<div class="category-links">
				<?php
					$parent = $pages->get('/categories/');
					$children = $parent->children("limit=10");
					foreach($children as $child) {
		        echo "<li><a class='category-link' href='{$child->url}'>{$child->title}</a></li>";
		    	}
				?>
			</div>
		</section>
		<section>
			<?php

				$entries = $pages->find('template=blog-entry, limit=9, sort=-created');

				foreach($entries as $entry) {
					$publish_date = date('d-m-Y', $entry->created);
					$date = "{$publish_date}";
					echo '<article class="blog-post-link">';
					$image = $entry->get('featured_image');
					echo "<a href='{$entry->url}'>";
					if($image){
					echo "<div class='featured-image' style='background-image: url({$image->url});'></div>";
					}
					echo '<p class="date">';
					echo $date;
					echo '</p>';
					echo "<h2>{$entry->title}</h2>";
					echo '<p>';
					echo wordLimiter($entry->body);
					echo '</p>';
					echo "<p class='category'>{$entry->categories->title}</p>";
					echo "</a>";
					echo '</article>';
					};
			?>
		</section>
		<?php
		echo $entries->renderPager(array(
			'nextItemLabel' => "Next",
			'previousItemLabel' => "Prev",
			'listMarkup' => "<ul class='MarkupPagerNav'>{out}</ul>",
			'itemMarkup' => "<li class='{class}'>{out}</li>",
			'linkMarkup' => "<a href='{url}'><span>{out}</span></a>"
		));
		?>
	</div>
</div><!-- end content -->

<?php include('./_foot.php'); // include footer markup ?>
