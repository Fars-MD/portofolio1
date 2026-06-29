<script setup>
import { useScrollReveal } from '../composables/useScrollReveal'
import { personalInfo } from '../data/portfolio'

useScrollReveal()
</script>

<template>
  <section id="about" class="about">
    <div class="container">
      <div class="section-header reveal">
        <h2>About Me</h2>
        <div class="divider"></div>
      </div>
      <div class="about-content">
        <div class="about-text reveal">
          <p>{{ personalInfo.bio }}</p>
          <p>{{ personalInfo.longBio }}</p>
          <div class="about-info">
            <div class="info-item"><span class="info-label">Email</span><span class="info-value">{{ personalInfo.email }}</span></div>
            <div class="info-item"><span class="info-label">Phone</span><span class="info-value">{{ personalInfo.phone }}</span></div>
            <div class="info-item"><span class="info-label">Location</span><span class="info-value">{{ personalInfo.location }}</span></div>
          </div>
        </div>
        <div class="about-stats">
          <div v-for="(stat, i) in [
            { num: '3+', label: 'Years Experience' },
            { num: '20+', label: 'Projects Done' },
            { num: '15+', label: 'Happy Clients' },
            { num: '99%', label: 'Satisfaction' },
          ]" :key="stat.label" class="stat-card reveal" :style="{ transitionDelay: `${i * 0.1}s` }">
            <span class="stat-number">{{ stat.num }}</span>
            <span class="stat-label">{{ stat.label }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.about { padding: 100px 0; background: var(--bg-alt); }
.about-content { display: grid; grid-template-columns: 1.5fr 1fr; gap: 60px; align-items: start; }
.about-text p { color: var(--text-light); line-height: 1.8; margin-bottom: 16px; font-size: 1.05rem; }
.about-info { margin-top: 32px; display: flex; flex-direction: column; gap: 12px; }
.info-item { display: flex; gap: 12px; }
.info-label { font-weight: 600; color: var(--text-h); min-width: 80px; }
.info-value { color: var(--text-light); }
.about-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.stat-card {
  background: var(--bg); padding: 28px 20px; border-radius: 12px;
  text-align: center; border: 1px solid var(--border);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.stat-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: var(--shadow); }
.stat-number { display: block; font-size: 2rem; font-weight: 700; color: var(--primary); margin-bottom: 4px; }
.stat-label { font-size: 0.9rem; color: var(--text-light); }
@media (max-width: 768px) { .about-content { grid-template-columns: 1fr; gap: 40px; } }
</style>
