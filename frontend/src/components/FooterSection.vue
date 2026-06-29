<script setup>
import { useScrollReveal } from '../composables/useScrollReveal'
import { personalInfo } from '../data/portfolio'

useScrollReveal()
</script>

<template>
  <footer class="footer">
    <div class="container">
      <div class="footer-content reveal">
        <div class="footer-brand">
          <h3>{{ personalInfo.name }}</h3>
          <p>{{ personalInfo.role }}</p>
        </div>
        <div class="footer-links">
          <h4>Quick Links</h4>
          <a href="#hero">Home</a>
          <a href="#about">About</a>
          <a href="#skills">Skills</a>
          <a href="#projects">Projects</a>
          <a href="#contact">Contact</a>
        </div>
        <div class="footer-social">
          <h4>Connect</h4>
          <a :href="personalInfo.social.github" target="_blank">GitHub</a>
          <a :href="personalInfo.social.linkedin" target="_blank">LinkedIn</a>
          <a :href="personalInfo.social.twitter" target="_blank">Twitter</a>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; {{ new Date().getFullYear() }} {{ personalInfo.name }}. All rights reserved.</p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer { background: var(--bg-alt); border-top: 1px solid var(--border); padding: 60px 0 0; }
.footer-content {
  display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 60px;
  padding-bottom: 40px; border-bottom: 1px solid var(--border);
}
.footer-brand h3 { font-size: 1.5rem; margin-bottom: 8px; color: var(--text-h); }
.footer-brand p { color: var(--text-light); }
.footer-links h4, .footer-social h4 { font-size: 1rem; color: var(--text-h); margin-bottom: 16px; }
.footer-links, .footer-social { display: flex; flex-direction: column; gap: 10px; }
.footer-links a, .footer-social a {
  color: var(--text-light); text-decoration: none;
  transition: all 0.3s ease; width: fit-content;
  position: relative; padding-left: 0;
}
.footer-links a::before, .footer-social a::before {
  content: ''; position: absolute; bottom: -2px; left: 0;
  width: 0; height: 1px; background: var(--primary);
  transition: width 0.3s ease;
}
.footer-links a:hover, .footer-social a:hover { color: var(--primary); }
.footer-links a:hover::before, .footer-social a:hover::before { width: 100%; }
.footer-bottom { padding: 24px 0; text-align: center; }
.footer-bottom p { color: var(--text-light); font-size: 0.9rem; }
@media (max-width: 768px) {
  .footer-content { grid-template-columns: 1fr; text-align: center; gap: 32px; }
  .footer-links a, .footer-social a { margin: 0 auto; }
}
</style>
