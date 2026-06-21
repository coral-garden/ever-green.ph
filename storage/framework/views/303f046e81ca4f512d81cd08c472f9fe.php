<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<title><?php echo e($meta['title']); ?></title>
<meta name="description" content="<?php echo e($meta['description']); ?>" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Evergreen Solar" />
<meta property="og:locale" content="en_PH" />
<meta property="og:title" content="<?php echo e($meta['og_title']); ?>" />
<meta property="og:description" content="<?php echo e($meta['og_description']); ?>" />
<meta property="og:url" content="<?php echo e($meta['og_url']); ?>" />
<meta property="og:image" content="https://www.ever-green.ph/assets/og-cover.png" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="Evergreen Solar — solar for island living" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo e($meta['twitter_title']); ?>" />
<meta name="twitter:description" content="<?php echo e($meta['twitter_description']); ?>" />
<meta name="twitter:image" content="https://www.ever-green.ph/assets/og-cover.png" />

<link rel="canonical" href="<?php echo e($meta['canonical']); ?>" />
<meta name="theme-color" content="#07190F" />

<link rel="icon" type="image/png" href="/assets/favicon.png" />
<link rel="apple-touch-icon" href="/assets/logo.png" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600;700&family=Azeret+Mono:wght@400;500;600&family=Noto+Sans:wght@700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'" />
    <noscript><link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600;700&family=Azeret+Mono:wght@400;500;600&family=Noto+Sans:wght@700;800&display=swap" rel="stylesheet" /></noscript>

<link rel="stylesheet" href="/assets/site.css" />
<?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>

  <?php if (isset($component)) { $__componentOriginale7973a0cd111432859375f720ac31db5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7973a0cd111432859375f720ac31db5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale7973a0cd111432859375f720ac31db5)): ?>
<?php $attributes = $__attributesOriginale7973a0cd111432859375f720ac31db5; ?>
<?php unset($__attributesOriginale7973a0cd111432859375f720ac31db5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7973a0cd111432859375f720ac31db5)): ?>
<?php $component = $__componentOriginale7973a0cd111432859375f720ac31db5; ?>
<?php unset($__componentOriginale7973a0cd111432859375f720ac31db5); ?>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>

  <?php if (isset($component)) { $__componentOriginal21120ef38d90a9d572330a5268a23b04 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal21120ef38d90a9d572330a5268a23b04 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal21120ef38d90a9d572330a5268a23b04)): ?>
<?php $attributes = $__attributesOriginal21120ef38d90a9d572330a5268a23b04; ?>
<?php unset($__attributesOriginal21120ef38d90a9d572330a5268a23b04); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal21120ef38d90a9d572330a5268a23b04)): ?>
<?php $component = $__componentOriginal21120ef38d90a9d572330a5268a23b04; ?>
<?php unset($__componentOriginal21120ef38d90a9d572330a5268a23b04); ?>
<?php endif; ?>

<script src="/assets/site.js" defer></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/dahican/Library/CloudStorage/Dropbox/ever-green.ph/resources/views/layouts/app.blade.php ENDPATH**/ ?>