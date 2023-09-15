<?php 
require_once __DIR__.'/../src/Submit.php';

/**
 * @var DateTime $date
 * @var string $currency
 * @var float $rate
 * @var bool $result
 * @var string $error_msg
 */
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Foreign exchange rates from HMRC">
		<title>Exchange Rates from HMRC</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<a class="visually-hidden-focusable" href="#content">Skip to main content</a>
		<div class="container">
			<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
				<a href="/projects/exrates/public/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none" title="Homepage">
					<span class="fs-4">HMRC Exchange Rates&nbsp;</span>
					<i class="bi bi-currency-exchange"></i>
				</a>
			</header>
			<main id="content">
				<div class="row align-items-center g-lg-5 py-3">
					<section class="col-lg-7 text-center text-lg-start">
						<h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Check the monthly foreign exchange rates from HMRC</h1>
					</section>
					<section class="col-md-10 col-lg-5 mx-auto">
						<form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method="get" autocomplete="off">
							<div class="form-floating mb-3">
							<?php if (empty($date)): ?>
								<input type="text" class="form-control" id="fdate" name="d" value="" placeholder="DD/MM/YYYY" required="true">
							<?php else: ?>
								<input type="text" class="form-control" id="fdate" name="d" value="<?= $date->format('d/m/Y'); ?>" placeholder="DD/MM/YYYY" required="true">
							<?php endif; ?>
								<label for="fdate">Date</label>
							</div>
							<div class="form-floating mb-3">
							<?php if (empty($currency)): ?>
								<input type="text" class="form-control" id="fcurrency" name="c" value="" placeholder="Currency" required="true">
							<?php else: ?>
								<input type="text" class="form-control" id="fcurrency" name="c" value="<?= htmlspecialchars($currency); ?>" placeholder="Currency" required="true">
							<?php endif; ?>	
								<label for="fcurrency">Currency code</label>
							</div>
							<button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" value="true">Submit</button>
							<hr class="my-4">
						</form>
					</section>
				</div>
				<?php if (isset($result)): ?>
				<div class="row align-items-center g-lg-5">
					<div class="col-lg-7"></div>
					<section class="col-md-10 col-lg-5 mx-auto">
						<?php if (FALSE === $result): ?>
						<div class="card text-bg-danger">
							<div class="card-body">
								<p class="card-text"><?= htmlspecialchars($error_msg); ?></p>
						<?php else: ?>
						<div class="card">
							<div class="card-body">
								<h5 class="card-title"><?= $date->format('F') . ' ' . $date->format('Y'); ?>:</h5>
								<p class="card-text">Currency units per £1 = <?= htmlspecialchars($rate) . ' ' . htmlspecialchars($currency); ?></p>
						<?php endif; ?>
							</div>
						</div>
					</section>
				</div>
				<?php endif; ?>
			</main>
			<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
				<div class="col-md-4 d-flex align-items-center">
					<span class="mb-3 mb-md-0 text-body-secondary">&copy; <?= date("Y"); ?> Rallien IT</span>
				</div>
				<ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
					<li class="ms-3"><a class="text-body-secondary" href="https://github.com/reisrony/foreign-exchange-rates" target="_blank" title="github" rel="noreferrer"><i class="bi bi-github"></i></a></li>
					<li class="ms-3"><a class="text-body-secondary" href="https://bitbucket.org/reisrony/foreign-exchange-rates" target="_blank" title="Bitbucket" rel="noreferrer"><i class="bi bi-git"></i></a></li>
				</ul>
			</footer>
		</div>
	</body>
</html>