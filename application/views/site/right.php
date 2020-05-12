<div class="right">
	<!-- The Support -->
	<div class="box-right">
		<div class="title tittle-box-right">
			<h2> Hỗ trợ trực tuyến </h2>
		</div>
		<div class="content-box">
			<!-- goi ra phuong thuc hien thi danh sach ho tro -->
			<div class="support">
				<strong>Minh Haui 98 </strong>
				

				<p>
					<img style="margin-bottom:-3px" src="<?php echo public_url() ?>site/images/phone.png"> 0364259955 </p>

				<p>
					<a rel="nofollow" href="mailto:hoangvantuyencnt@gmail.com">
						<img style="margin-bottom:-3px" src="<?php echo public_url() ?>site/images/email.png"> Email: minhproz1998@gmail.com
					</a>
				</p>
				<p>
					<a rel="nofollow" href="skype:tuyencnt90">
						<img style="margin-bottom:-3px" src="<?php echo public_url() ?>site/images/skype.png"> Skype: minhhaui98 </a>
				</p>
			</div>
		</div>
	</div>
	<!-- End Support -->

	<!-- The news -->
	<div class="box-right">
		<div class="title tittle-box-right">
			<h2> Bài viết mới </h2>
		</div>
		<div class="content-box">

			<ul class="news">
				<?php foreach ($news as $n) : ?>
					<li>
						<a href="<?php echo site_url('news/view/'.$n->id) ?>" title="<?= $n->intro ?>" class="content-news">
							<img src="<?php echo base_url("upload/news/" . $n->image_link) ?>" style="height:30px">
							<?= $n->title ?>
						 </a>
					</li>

				<?php endforeach; ?>
			</ul>
		</div>
	</div> <!-- End news -->

	<!-- The Ads -->
	<div class="box-right">
		<div class="title tittle-box-right">
			<h2> Quảng cáo </h2>
		</div>
		<div class="content-box">
			<a href="">
				<img src="<?php echo public_url() ?>site/images/ads.png">
			</a>
		</div>
	</div>
	<!-- End Ads -->

	<!-- The Fanpage -->
	<div class="box-right">
		<div class="title tittle-box-right">
			<h2> Fanpage </h2>
		</div>
		<div class="content-box">

			<iframe src="http://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/nobitacnt&amp;width=190&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:190px; height:300px;" allowtransparency="true">
			</iframe>

		</div>
	</div>
	<!-- End Fanpage -->

	<!-- The Fanpage -->
	<div class="box-right">
		<div class="title tittle-box-right">
			<h2> Thống kê truy cập </h2>
		</div>
		<div class="content-box">
			<center>
				<!-- Histats.com  START  (standard)-->
				<script type="text/javascript">
					document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));
				</script>
				<script src="http://s10.histats.com/js15.js" type="text/javascript"></script>
				<a href="http://www.histats.com" target="_blank" title="hit counter">
					<script type="text/javascript">
						try {
							Histats.start(1, 2138481, 4, 401, 118, 80, "00011111");
							Histats.track_hits();
						} catch (err) {};
					</script>
					<div id="histats_counter_1931" style="display: block;"><a href="http://www.histats.com/viewstats/?sid=2138481&amp;ccid=401" target="_blank"><canvas id="histats_counter_1931_canvas" width="119" height="81"></canvas></a></div>
				</a>
				<noscript><a href="http://www.histats.com" target="_blank"><img src="http://sstatic1.histats.com/0.gif?2138481&101" alt="hit counter" border="0"></a></noscript>
				<!-- Histats.com  END  -->
			</center>
		</div>
	</div>
	<!-- End Fanpage -->


</div>

<style>
	.content-news p{
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>