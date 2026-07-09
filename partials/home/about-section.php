<?php
/* =========================================================
  about-section.php
  - Debe ser incluido en una página donde YA se cargó text.php
  - Requisito: incluir imagen principal de servicio
========================================================= */

$about = (isset($HomeAboutCopy) && is_array($HomeAboutCopy)) ? $HomeAboutCopy : [];

$aboutEyebrow     = trim((string) ($about['eyebrow'] ?? ''));
$aboutTitle       = trim((string) ($about['title'] ?? ''));
$aboutTitleStrong = trim((string) ($about['title_strong'] ?? ''));
$aboutDesc        = trim((string) ($about['description'] ?? ''));

$yearsValue = (int) ($ExperienceYears ?? 0);
if ($yearsValue <= 0) $yearsValue = 1;

$yearsLabel    = trim((string) ($about['badge_label'] ?? ''));
$coverageLabel = trim((string) ($Coverage ?? ''));
$licenseLabel  = trim((string) ($LicenseNote ?? ''));
$bilingualLabel= trim((string) ($BilingualNote ?? ''));

$features = (isset($about['features']) && is_array($about['features'])) ? $about['features'] : [];

// Imagen principal del bloque about
$aboutImg = trim((string) (
  $about['images']['back']['src']
  ?? $about['images']['front']['src']
  ?? (function_exists('stockImage') ? stockImage('about') : '')
));
$aboutImgAlt = trim((string) (
  $about['images']['back']['alt']
  ?? $about['images']['front']['alt']
  ?? ($PageHeroCopy['about']['title'] ?? 'Water well service image')
));
if ($aboutImg === '') $aboutImg = function_exists('stockImage') ? stockImage('about') : '';
if ($aboutImgAlt === '') $aboutImgAlt = 'Water well service image';
$aboutVideo = trim((string) ($AboutVideo ?? ''));

$ctaText = trim((string) ($about['cta'] ?? ($NavCopy['about'] ?? 'Learn more')));
$ctaHref = 'about.php';

$telHref = trim((string) ($PhoneRef ?? 'contact.php'));
$telText = trim((string) ($Phone ?? ''));

?>
<style>
/* =========================
   ABOUT SECTION (Premium Arch)
   ========================= */
.section-about-arch{
  position:relative;
  padding: clamp(72px, 7vw, 118px) 0 clamp(88px, 8vw, 132px);
  background:
    radial-gradient(58% 76% at 7% 4%, rgba(var(--brand-accent-rgb),0.16) 0%, transparent 62%),
    linear-gradient(180deg, #fbfaf6 0%, var(--site-surface-soft) 100%);
  overflow: clip;
}

.section-about-arch::before{
  content:"";
  position:absolute;
  inset:0;
  background-image:
    linear-gradient(rgba(0,0,0,0.045) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0,0,0,0.045) 1px, transparent 1px);
  background-size: 54px 54px;
  opacity: .24;
  pointer-events:none;
}

.section-about-arch::after{
  content:"";
  position:absolute;
  top: clamp(88px, 9vw, 132px);
  right: 0;
  width: min(45vw, 720px);
  height: clamp(430px, 45vw, 620px);
  background: linear-gradient(145deg, rgba(var(--brand-primary-rgb),0.08), rgba(var(--brand-accent-rgb),0.14));
  clip-path: polygon(12% 0, 100% 0, 100% 88%, 0 100%, 0 16%);
  pointer-events:none;
}

.section-about-arch .arch-shell{
  width: min(1360px, 92vw);
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.section-about-arch .arch-grid{
  display:grid;
  grid-template-columns: minmax(420px, 0.92fr) minmax(0, 1.08fr);
  gap: clamp(32px, 5vw, 76px);
  align-items: center;
}

.section-about-arch .arch-eyebrow{
  display:inline-flex;
  align-items:center;
  gap:10px;
  padding: 8px 12px;
  border-radius: 10px;
  border: 1px solid rgba(var(--brand-accent-rgb),0.40);
  background: rgba(255,255,255,0.84);
  color: var(--site-ink);
  font-weight: 800;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  font-size: 11px;
}

.section-about-arch .arch-eyebrow::before{
  content:"";
  width: 9px;
  height: 9px;
  border-radius: 999px;
  background: var(--brand-accent);
  box-shadow: 0 0 0 6px rgba(var(--brand-accent-rgb),0.16);
}

.section-about-arch .content-arch h2{
  margin: 18px 0 0;
  font-family: var(--font-display, ui-sans-serif, system-ui);
  color: var(--brand-secondary);
  font-size: clamp(2.35rem, 4.9vw, 4.35rem);
  line-height: .9;
  letter-spacing: 0;
  text-wrap: balance;
}

.section-about-arch .content-arch h2 strong{
  color: var(--brand-primary);
  font-weight: 800;
  display:block;
}

.section-about-arch .content-arch p{
  margin: 18px 0 0;
  color: var(--site-ink-soft);
  line-height: 1.68;
  max-width: 58ch;
  font-size: 1.02rem;
  text-wrap: pretty;
}

.section-about-arch .arch-badges{
  margin-top: 22px;
  display:grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 8px;
  max-width: 620px;
}

.section-about-arch .arch-badge{
  display:inline-flex;
  align-items:center;
  gap: 10px;
  min-height: 48px;
  padding: 9px 12px;
  border-radius: 12px;
  background: rgba(255,255,255,0.78);
  border: 1px solid var(--site-line);
  color: var(--site-ink);
  font-weight: 800;
  letter-spacing: .4px;
  font-size: 12px;
}

.section-about-arch .arch-badge:nth-child(3){
  grid-column: 1 / -1;
}

.section-about-arch .arch-badge i{
  width: 30px;
  height: 30px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  border-radius: 999px;
  background: rgba(var(--brand-accent-rgb),0.10);
  color: var(--brand-accent);
}

.section-about-arch .arch-features{
  margin-top: 16px;
  display:grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
  max-width: 620px;
}

.section-about-arch .arch-feature{
  position:relative;
  border-radius: 12px;
  border: 1px solid var(--site-line);
  background: rgba(255,255,255,0.82);
  box-shadow: 0 14px 34px rgba(var(--brand-primary-rgb),0.08);
  padding: 14px 14px 14px 16px;
  display:flex;
  gap: 12px;
  align-items:flex-start;
  transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
}

.section-about-arch .arch-feature::before{
  content:"";
  position:absolute;
  left:0;
  top:14px;
  bottom:14px;
  width: 3px;
  border-radius: 999px;
  background: var(--brand-accent);
}

.section-about-arch .arch-feature:hover{
  transform: translateY(-3px);
  border-color: rgba(var(--brand-accent-rgb),0.42);
  box-shadow: 0 20px 44px rgba(var(--brand-primary-rgb),0.12);
}

.section-about-arch .feature-icon{
  width: 38px;
  height: 38px;
  border-radius: 10px;
  background: linear-gradient(145deg, rgba(var(--brand-secondary-rgb),0.92), rgba(var(--brand-primary-rgb),0.74));
  color: var(--brand-accent);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  flex: 0 0 auto;
}

.section-about-arch .feature-body h3{
  margin: 0;
  color: var(--site-ink);
  font-weight: 900;
  letter-spacing: 0;
  font-size: .98rem;
}

.section-about-arch .feature-body p{
  margin: 6px 0 0;
  color: var(--site-ink-soft);
  line-height: 1.6;
  font-size: .95rem;
}

.section-about-arch .arch-actions{
  margin-top: 22px;
  display:flex;
  flex-wrap: wrap;
  gap: 10px;
}

.section-about-arch .btn-arch{
  min-height: 48px;
  border-radius: 12px;
  padding: 10px 18px;
  text-decoration:none;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 11px;
  font-weight: 900;
  border: 1px solid transparent;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  transition: transform .2s ease, background-color .2s ease, border-color .2s ease, color .2s ease;
}

.section-about-arch .btn-arch:focus-visible{
  outline: 3px solid rgba(var(--brand-accent-rgb),0.42);
  outline-offset: 3px;
}

.section-about-arch .btn-arch--primary{
  background: var(--brand-accent);
  border-color: var(--brand-accent);
  color: var(--brand-secondary);
}

.section-about-arch .btn-arch--secondary{
  background: rgba(var(--brand-secondary-rgb),0.10);
  border-color: rgba(var(--brand-secondary-rgb),0.22);
  color: var(--brand-secondary);
}

.section-about-arch .btn-arch:hover{
  transform: translateY(-2px);
}

.section-about-arch .arch-media{
  position:relative;
  border-radius: 12px;
  overflow:hidden;
  border: 1px solid rgba(var(--brand-primary-rgb),0.18);
  box-shadow: 0 36px 90px rgba(var(--brand-primary-rgb),0.20);
  background: #101821;
  isolation:isolate;
}

.section-about-arch .arch-media::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    linear-gradient(90deg, rgba(var(--brand-primary-rgb),0.16) 0%, rgba(var(--brand-primary-rgb),0.02) 48%, rgba(var(--brand-primary-rgb),0.24) 100%),
    linear-gradient(180deg, rgba(0,0,0,0) 42%, rgba(0,0,0,0.44) 100%);
  pointer-events:none;
  z-index: 1;
}

.section-about-arch .arch-media::after{
  content:"";
  position:absolute;
  inset: 14px;
  border: 1px solid rgba(255,255,255,0.18);
  border-radius: 8px;
  pointer-events:none;
  z-index:2;
}

.section-about-arch .arch-media img,
.section-about-arch .arch-media video{
  width:100%;
  height: clamp(430px, 45vw, 640px);
  object-fit: cover;
  object-position: center center;
  display:block;
  filter: saturate(1.06) contrast(1.02);
}

.section-about-arch .arch-video-caption{
  position:absolute;
  left: 24px;
  right: 24px;
  bottom: 24px;
  z-index:3;
  display:flex;
  justify-content:space-between;
  gap: 16px;
  align-items:flex-end;
  color:#fff;
  pointer-events:none;
}

.section-about-arch .arch-video-caption strong{
  display:block;
  color:#fff;
  font-family: var(--font-display, ui-sans-serif, system-ui);
  font-size: clamp(1.35rem, 2.4vw, 2.2rem);
  line-height:.95;
  letter-spacing:0;
  text-transform:uppercase;
}

.section-about-arch .arch-video-caption span{
  display:block;
  margin-top:6px;
  color:rgba(255,255,255,.78);
  font-size:11px;
  font-weight:800;
  letter-spacing:1.1px;
  text-transform:uppercase;
}

.section-about-arch .arch-video-badge{
  flex:0 0 auto;
  min-height:38px;
  display:inline-flex;
  align-items:center;
  gap:8px;
  border-radius:10px;
  padding:0 12px;
  background:rgba(0,0,0,.38);
  border:1px solid rgba(255,255,255,.24);
  backdrop-filter: blur(8px);
  color:#fff;
  font-size:11px;
  font-weight:900;
  letter-spacing:.9px;
  text-transform:uppercase;
}

.section-about-arch .media-card{
  position:absolute;
  z-index: 2;
  left: 14px;
  bottom: 14px;
  right: 14px;
  display:grid;
  grid-template-columns: repeat(3, minmax(0,1fr));
  gap: 10px;
}

.section-about-arch .media-pill{
  border-radius: 16px;
  border: 1px solid rgba(255,255,255,0.28);
  background: rgba(0,0,0,0.36);
  color: rgba(255,255,255,0.92);
  padding: 12px;
  backdrop-filter: blur(6px);
}

.section-about-arch .media-pill strong{
  display:block;
  font-weight: 900;
  letter-spacing: .3px;
  font-size: 1.05rem;
  line-height: 1.2;
}

.section-about-arch .media-pill span{
  display:block;
  margin-top: 4px;
  font-size: 11px;
  letter-spacing: 1px;
  text-transform: uppercase;
  opacity: .86;
}

.section-about-arch .arch-media--video .media-card{
  display:none;
}

@media (max-width: 980px){
  .section-about-arch{
    padding: 56px 0 78px;
  }

  .section-about-arch .arch-grid{ grid-template-columns: 1fr; }
  .section-about-arch::after{ width:100%; opacity:.45; }
  .section-about-arch .arch-features{ grid-template-columns: 1fr; }
  .section-about-arch .media-card{ grid-template-columns: 1fr; }
  .section-about-arch .arch-badges{ grid-template-columns: 1fr; }
  .section-about-arch .arch-badge:nth-child(3){ grid-column:auto; }
  .section-about-arch .arch-media img,
  .section-about-arch .arch-media video{ height: clamp(300px, 62vw, 470px); }
}

@media (max-width: 640px){
  .section-about-arch .arch-video-caption{
    left: 16px;
    right: 16px;
    bottom: 16px;
    display:block;
  }

  .section-about-arch .arch-video-badge{
    margin-top:10px;
  }
}

@media (prefers-reduced-motion: reduce){
  .section-about-arch .btn-arch{ transition: none; }
  .section-about-arch .btn-arch:hover{ transform: none; }
  .section-about-arch .arch-feature{ transition:none; }
  .section-about-arch .arch-feature:hover{ transform:none; }
}
</style>

<section class="section-about-arch" id="about">
  <div class="arch-shell">
    <div class="arch-grid">
      <div class="content-arch">
        <?php if ($aboutEyebrow !== ''): ?>
          <span class="arch-eyebrow"><?php echo htmlspecialchars($aboutEyebrow, ENT_QUOTES, 'UTF-8'); ?></span>
        <?php endif; ?>

        <?php if ($aboutTitle !== '' || $aboutTitleStrong !== ''): ?>
          <h2>
            <?php echo htmlspecialchars($aboutTitle, ENT_QUOTES, 'UTF-8'); ?>
            <?php if ($aboutTitleStrong !== ''): ?>
              <strong><?php echo htmlspecialchars($aboutTitleStrong, ENT_QUOTES, 'UTF-8'); ?></strong>
            <?php endif; ?>
          </h2>
        <?php endif; ?>

        <?php if ($aboutDesc !== ''): ?>
          <p><?php echo htmlspecialchars($aboutDesc, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <div class="arch-badges" aria-label="Company highlights">
          <?php if ($yearsLabel !== ''): ?>
            <span class="arch-badge">
              <i class="fa-solid fa-star" aria-hidden="true"></i>
              <?php echo (int) $yearsValue; ?>+ <?php echo htmlspecialchars($yearsLabel, ENT_QUOTES, 'UTF-8'); ?>
            </span>
          <?php endif; ?>

          <?php if ($licenseLabel !== ''): ?>
            <span class="arch-badge">
              <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
              <?php echo htmlspecialchars($licenseLabel, ENT_QUOTES, 'UTF-8'); ?>
            </span>
          <?php endif; ?>

          <?php if ($coverageLabel !== ''): ?>
            <span class="arch-badge">
              <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
              <?php echo htmlspecialchars($coverageLabel, ENT_QUOTES, 'UTF-8'); ?>
            </span>
          <?php endif; ?>

          <?php if ($bilingualLabel !== ''): ?>
            <span class="arch-badge">
              <i class="fa-solid fa-comments" aria-hidden="true"></i>
              <?php echo htmlspecialchars($bilingualLabel, ENT_QUOTES, 'UTF-8'); ?>
            </span>
          <?php endif; ?>
        </div>

        <?php if (!empty($features)): ?>
          <div class="arch-features" aria-label="Key features">
            <?php foreach ($features as $feat): ?>
              <?php
                $fi = trim((string) ($feat['icon'] ?? 'fa-clipboard-list'));
                $ft = trim((string) ($feat['title'] ?? ''));
                $fx = trim((string) ($feat['text'] ?? ''));
                if ($ft === '' && $fx === '') continue;
              ?>
              <article class="arch-feature">
                <div class="feature-icon" aria-hidden="true">
                  <i class="fa-solid <?php echo htmlspecialchars($fi, ENT_QUOTES, 'UTF-8'); ?>"></i>
                </div>
                <div class="feature-body">
                  <?php if ($ft !== ''): ?><h3><?php echo htmlspecialchars($ft, ENT_QUOTES, 'UTF-8'); ?></h3><?php endif; ?>
                  <?php if ($fx !== ''): ?><p><?php echo htmlspecialchars($fx, ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="arch-actions">
          <a class="btn-arch btn-arch--primary" href="<?php echo htmlspecialchars($ctaHref, ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($ctaText, ENT_QUOTES, 'UTF-8'); ?>
          </a>

          <?php if ($telText !== '' && $telHref !== ''): ?>
            <a class="btn-arch btn-arch--secondary" href="<?php echo htmlspecialchars($telHref, ENT_QUOTES, 'UTF-8'); ?>">
              <?php echo htmlspecialchars($telText, ENT_QUOTES, 'UTF-8'); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="arch-media<?php echo $aboutVideo !== '' ? ' arch-media--video' : ''; ?>">
        <?php if ($aboutVideo !== ''): ?>
          <video
            poster="<?php echo htmlspecialchars($aboutImg, ENT_QUOTES, 'UTF-8'); ?>"
            autoplay
            loop
            muted
            playsinline
            preload="auto"
            aria-label="<?php echo htmlspecialchars($aboutImgAlt, ENT_QUOTES, 'UTF-8'); ?>"
          >
            <source src="<?php echo htmlspecialchars($aboutVideo, ENT_QUOTES, 'UTF-8'); ?>" type="video/mp4">
          </video>
          <div class="arch-video-caption" aria-hidden="true">
            <div>
              <strong>Field service</strong>
              <span>Water well and contracting support</span>
            </div>
            <div class="arch-video-badge">
              <i class="fa-solid fa-play"></i>
              On site
            </div>
          </div>
        <?php else: ?>
          <img
            src="<?php echo htmlspecialchars($aboutImg, ENT_QUOTES, 'UTF-8'); ?>"
            alt="<?php echo htmlspecialchars($aboutImgAlt, ENT_QUOTES, 'UTF-8'); ?>"
            loading="lazy"
            decoding="async"
          />
        <?php endif; ?>

        <div class="media-card" aria-hidden="true">
          <div class="media-pill">
            <strong><?php echo (int) $yearsValue; ?>+</strong>
            <span><?php echo htmlspecialchars(($yearsLabel !== '' ? $yearsLabel : 'Years'), ENT_QUOTES, 'UTF-8'); ?></span>
          </div>
          <div class="media-pill">
            <strong><?php echo htmlspecialchars(($licenseLabel !== '' ? $licenseLabel : 'Insured'), ENT_QUOTES, 'UTF-8'); ?></strong>
            <span><?php echo htmlspecialchars(($NavCopy['services'] ?? 'Services'), ENT_QUOTES, 'UTF-8'); ?></span>
          </div>
          <div class="media-pill">
            <strong><?php echo htmlspecialchars(($coverageLabel !== '' ? $coverageLabel : 'Coverage'), ENT_QUOTES, 'UTF-8'); ?></strong>
            <span><?php echo htmlspecialchars(($NavCopy['contact_today'] ?? 'Contact'), ENT_QUOTES, 'UTF-8'); ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if ($aboutVideo !== ''): ?>
<script>
(function () {
  var video = document.querySelector('#about video');
  if (!video) return;

  video.muted = true;
  video.defaultMuted = true;
  video.playsInline = true;

  function tryPlay() {
    var promise = video.play && video.play();
    if (promise && typeof promise.catch === 'function') {
      promise.catch(function () {});
    }
  }

  video.addEventListener('loadeddata', tryPlay, { once: true });
  video.addEventListener('canplay', tryPlay, { once: true });

  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          tryPlay();
        }
      });
    }, { threshold: 0.22 });
    observer.observe(video);
  } else {
    tryPlay();
  }
})();
</script>
<?php endif; ?>
