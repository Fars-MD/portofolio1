<script setup>
import { ref, onMounted } from 'vue'
import { personalInfo } from '../data/portfolio'

const displayText = ref('')
const fullText = personalInfo.role
let charIndex = 0

onMounted(() => {
  const interval = setInterval(() => {
    if (charIndex < fullText.length) {
      displayText.value += fullText[charIndex]
      charIndex++
    } else {
      clearInterval(interval)
    }
  }, 80)
})
</script>

<template>
  <section id="hero" class="hero">
    <div class="container">
      <div class="hero-content">
        <p class="hero-greeting animate-slide-up" style="animation-delay: 0.2s">Hello, I'm</p>
        <h1 class="hero-name animate-slide-up" style="animation-delay: 0.4s">{{ personalInfo.name }}</h1>
        <h2 class="hero-role animate-slide-up" style="animation-delay: 0.6s">
          {{ displayText }}<span class="cursor">|</span>
        </h2>
        <p class="hero-tagline animate-slide-up" style="animation-delay: 0.8s">{{ personalInfo.tagline }}</p>
        <div class="hero-actions animate-slide-up" style="animation-delay: 1s">
          <a :href="personalInfo.resumeUrl" class="btn btn-primary btn-pulse">Download CV</a>
          <a href="#contact" class="btn btn-outline btn-glow" @click.prevent="() => document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth' })">Contact Me</a>
        </div>
        <div class="hero-social animate-slide-up" style="animation-delay: 1.2s">
          <a :href="personalInfo.social.github" target="_blank" aria-label="GitHub" class="social-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
          </a>
          <a :href="personalInfo.social.linkedin" target="_blank" aria-label="LinkedIn" class="social-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a :href="personalInfo.social.twitter" target="_blank" aria-label="Twitter" class="social-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
        </div>
      </div>
      <div class="hero-visual animate-fade-in" style="animation-delay: 1s">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.hero {
  min-height: 100vh; display: flex; align-items: center;
  padding: 100px 0 60px; position: relative; overflow: hidden;
}
.hero .container { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
.hero-content { max-width: 600px; }
.hero-greeting { color: var(--primary); font-size: 1.1rem; font-weight: 500; margin-bottom: 8px; letter-spacing: 1px; }
.hero-name { font-size: 3.5rem; font-weight: 800; margin: 0 0 8px; line-height: 1.1; color: var(--text-h); }
.hero-role { font-size: 1.5rem; font-weight: 600; color: var(--primary); margin-bottom: 16px; min-height: 2rem; }
.cursor { animation: blink 0.8s infinite; font-weight: 100; }
@keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
.hero-tagline { font-size: 1.15rem; color: var(--text-light); line-height: 1.7; margin-bottom: 32px; }
.hero-actions { display: flex; gap: 16px; margin-bottom: 40px; }
.hero-social { display: flex; gap: 16px; }
.social-icon {
  width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
  border-radius: 50%; border: 2px solid var(--border); color: var(--text-light);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.social-icon:hover {
  border-color: var(--primary); color: var(--primary);
  transform: translateY(-3px) scale(1.1); box-shadow: 0 4px 12px rgba(108, 99, 255, 0.3);
}
.hero-visual { display: flex; justify-content: center; align-items: center; position: relative; }

.floating-shape {
  position: absolute; border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  opacity: 0.08;
}
.shape-1 {
  width: 350px; height: 350px;
  animation: float 6s ease-in-out infinite;
}
.shape-2 {
  width: 200px; height: 200px;
  animation: float 8s ease-in-out infinite reverse;
  opacity: 0.05; top: -50px; right: -50px;
}
.shape-3 {
  width: 120px; height: 120px;
  animation: float 5s ease-in-out infinite 1s;
  opacity: 0.06; bottom: -30px; left: -30px;
}
@keyframes float {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  33% { transform: translateY(-20px) rotate(120deg); }
  66% { transform: translateY(10px) rotate(240deg); }
}
@keyframes slideUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-slide-up { animation: slideUp 0.6s ease-out both; }
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.9); }
  to { opacity: 1; transform: scale(1); }
}
.animate-fade-in { animation: fadeIn 0.8s ease-out both; }

@media (max-width: 768px) {
  .hero .container { grid-template-columns: 1fr; text-align: center; }
  .hero-name { font-size: 2.5rem; }
  .hero-actions, .hero-social { justify-content: center; }
  .hero-visual { display: none; }
}
</style>
