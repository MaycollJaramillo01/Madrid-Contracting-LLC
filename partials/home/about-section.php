<?php
/* =========================================================
  about-section.php
  - Debe ser incluido en una página donde YA se cargó text.php
  - Requisito: incluir imagen principal de towing
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
$aboutImg    = 'assets/img/truck.jpeg';
$aboutImgAlt = trim((string) (
  $about['images']['back']['alt']
  ?? $about['images']['front']['alt']
  ?? ($PageHeroCopy['about']['title'] ?? 'Towing service image')
));
if ($aboutImgAlt === '') $aboutImgAlt = 'Towing service image';

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
  padding: clamp(64px, 7vw, 110px) 0;
  background:
    radial-gradient(70% 90% at 10% 0%, rgba(var(--brand-accent-rgb),0.14) 0%, transparent 60%),
    radial-gradient(60% 75% at 92% 92%, rgba(var(--brand-primary-rgb),0.10) 0%, transparent 58%),
    linear-gradient(180deg, var(--site-surface) 0%, var(--site-surface-soft) 100%);
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
  opacity: .35;
  pointer-events:none;
}

.section-about-arch .arch-shell{
  width: min(1240px, 92vw);
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.section-about-arch .arch-grid{
  display:grid;
  grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
  gap: clamp(18px, 4vw, 56px);
  align-items: center;
}

.section-about-arch .arch-eyebrow{
  display:inline-flex;
  align-items:center;
  gap:10px;
  padding: 8px 14px;
  border-radius: 999px;
  border: 1px solid rgba(var(--brand-accent-rgb),0.40);
  background: rgba(255,255,255,0.72);
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
  margin: 16px 0 0;
  font-family: var(--font-display, ui-sans-serif, system-ui);
  color: var(--brand-secondary);
  font-size: clamp(2.1rem, 4.6vw, 3.5rem);
  line-height: .98;
  letter-spacing: .2px;
}

.section-about-arch .content-arch h2 strong{
  color: var(--brand-primary);
  font-weight: 800;
}

.section-about-arch .content-arch p{
  margin: 14px 0 0;
  color: var(--site-ink-soft);
  line-height: 1.75;
  max-width: 70ch;
  font-size: 1.02rem;
}

.section-about-arch .arch-badges{
  margin-top: 18px;
  display:flex;
  flex-wrap: wrap;
  gap: 10px;
}

.section-about-arch .arch-badge{
  display:inline-flex;
  align-items:center;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 999px;
  background: var(--site-panel-soft);
  border: 1px solid var(--site-line);
  color: var(--site-ink);
  font-weight: 800;
  letter-spacing: .4px;
  font-size: 12px;
}

.section-about-arch .arch-badge i{
  width: 28px;
  height: 28px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  border-radius: 999px;
  background: rgba(var(--brand-accent-rgb),0.10);
  color: var(--brand-accent);
}

.section-about-arch .arch-features{
  margin-top: 18px;
  display:grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}

.section-about-arch .arch-feature{
  border-radius: 16px;
  border: 1px solid var(--site-line);
  background: var(--site-panel-soft);
  box-shadow: 0 18px 40px rgba(0,0,0,0.08);
  padding: 14px;
  display:flex;
  gap: 12px;
  align-items:flex-start;
}

.section-about-arch .feature-icon{
  width: 40px;
  height: 40px;
  border-radius: 14px;
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
  letter-spacing: .3px;
  font-size: 1.02rem;
}

.section-about-arch .feature-body p{
  margin: 6px 0 0;
  color: var(--site-ink-soft);
  line-height: 1.6;
  font-size: .95rem;
}

.section-about-arch .arch-actions{
  margin-top: 20px;
  display:flex;
  flex-wrap: wrap;
  gap: 10px;
}

.section-about-arch .btn-arch{
  min-height: 48px;
  border-radius: 999px;
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
  border-radius: 22px;
  overflow:hidden;
  border: 1px solid rgba(0,0,0,0.14);
  box-shadow: 0 26px 64px rgba(0,0,0,0.14);
  background: #ffffff;
}

.section-about-arch .arch-media::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    radial-gradient(80% 90% at 10% 10%, rgba(var(--brand-accent-rgb),0.18) 0%, transparent 55%),
    linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.52) 100%);
  pointer-events:none;
  z-index: 1;
}

.section-about-arch .arch-media img{
  width:100%;
  height: clamp(340px, 42vw, 520px);
  object-fit: cover;
  display:block;
  filter: saturate(1.06) contrast(1.02);
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

@media (max-width: 980px){
  .section-about-arch .arch-grid{ grid-template-columns: 1fr; }
  .section-about-arch .arch-features{ grid-template-columns: 1fr; }
  .section-about-arch .media-card{ grid-template-columns: 1fr; }
}

@media (prefers-reduced-motion: reduce){
  .section-about-arch .btn-arch{ transition: none; }
  .section-about-arch .btn-arch:hover{ transform: none; }
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

      <div class="arch-media">
        <img
          src="<?php echo htmlspecialchars($aboutImg, ENT_QUOTES, 'UTF-8'); ?>"
          alt="<?php echo htmlspecialchars($aboutImgAlt, ENT_QUOTES, 'UTF-8'); ?>"
          loading="lazy"
          decoding="async"
        />

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
