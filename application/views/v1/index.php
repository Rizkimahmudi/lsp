					<!-- Thumbnail -->
					<section id="thumbnails">
						<?php if (isset($list) && count($list) && is_array($list)) : ?>
						<?php foreach ($list as $k=>$v) : ?>
						<article>
							<a class="thumbnail" href="images/fulls/01.jpg" data-position="left center"><img src="images/thumbs/01.jpg" alt="" /></a>
							<h2><?=htmlEncode($v['news_title'])?></h2>
							<p>L<?=htmlEncode($v['news_synopsis'])?></p>
						</article>
						<?php endforeach; ?>
						<?php endif; ?>
					</section>