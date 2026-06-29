<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { personalInfo } from '../data/portfolio'

const isScrolled = ref(false)
const isMenuOpen = ref(false)
const activeSection = ref('hero')

const navItems = [
  { label: 'Home', href: '#hero' },
  { label: 'About', href: '#about' },
  { label: 'Skills', href: '#skills' },
  { label: 'Projects', href: '#projects' },
  { label: 'Contact', href: '#contact' },
]

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50
  const sections = navItems.map(item => item.href.slice(1))
  for (let i = sections.length - 1; i >= 0; i--) {
    const el = document.getElementById(sections[i])
    if (el) {
      const rect = el.getBoundingClientRect()
      if (rect.top <= 150) {
        activeSection.value = sections[i]
        break
      }
    }
  }
}

const scrollTo = (href) => {
  isMenuOpen.value = false
  const id = href.slice(1)
  const el = document.getElementById(id)
  if (el) {
    el.scrollIntoView({ behavior: 'smooth' })
  }
}

onMounted(() => window.addEventListener('scroll', handleScroll))
onUnmounted(() => window.removeEventListener('scroll', handleScroll))
</script>

<template>
  <header :class="{ scrolled: isScrolled }">
    <div class="container nav-container">
      <a href="#hero" class="logo" @click.prevent="scrollTo('#hero')">
        {{ personalInfo.name }}
      </a>

      <button class="menu-toggle" :class="{ open: isMenuOpen }" @click="isMenuOpen = !isMenuOpen" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <nav :class="{ open: isMenuOpen }">
        <a v-for="item in navItems" :key="item.label" :href="item.href" :class="{ active: activeSection === item.href.slice(1) }" @click.prevent="scrollTo(item.href)">
          <span class="nav-label">{{ item.label }}</span>
          <span class="nav-indicator"></span>
        </a>
      </nav>
    </div>
  </header>
</template>

<style scoped>
header {
  position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
  padding: 20px 0; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  background: transparent;
  animation: slideDown 0.6s ease-out;
}
@keyframes slideDown {
  from { transform: translateY(-100%); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}
header.scrolled {
  background: var(--bg-nav); backdrop-filter: blur(12px);
  padding: 12px 0; box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.nav-container { display: flex; justify-content: space-between; align-items: center; }
.logo {
  font-size: 1.5rem; font-weight: 700; color: var(--text-h);
  text-decoration: none; position: relative;
}
.logo::after {
  content: ''; position: absolute; bottom: -2px; left: 0;
  width: 0; height: 2px; background: var(--primary);
  transition: width 0.3s ease;
}
.logo:hover::after { width: 100%; }

nav { display: flex; gap: 8px; }
nav a {
  text-decoration: none; color: var(--text-light); font-size: 0.95rem;
  font-weight: 500; padding: 8px 16px; border-radius: 8px;
  position: relative; overflow: hidden;
  transition: all 0.3s ease;
}
nav a::before {
  content: ''; position: absolute; inset: 0; border-radius: 8px;
  background: var(--primary); opacity: 0;
  transform: scale(0.8); transition: all 0.3s ease; z-index: -1;
}
nav a:hover::before, nav a.active::before {
  opacity: 0.1; transform: scale(1);
}
nav a:hover, nav a.active { color: var(--primary); }

.nav-indicator {
  position: absolute; bottom: 4px; left: 50%; transform: translateX(-50%);
  width: 0; height: 2px; background: var(--primary);
  border-radius: 1px; transition: width 0.3s ease;
}
nav a.active .nav-indicator { width: 20px; }

.menu-toggle {
  display: none; flex-direction: column; justify-content: center;
  gap: 5px; background: none; border: none; cursor: pointer;
  padding: 8px; z-index: 1001; width: 36px; height: 36px;
}
.menu-toggle span {
  display: block; width: 24px; height: 2px;
  background: var(--text-h); border-radius: 2px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  transform-origin: center;
}
.menu-toggle.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.menu-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.menu-toggle.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

@media (max-width: 768px) {
  .menu-toggle { display: flex; }
  nav {
    position: fixed; top: 0; right: -100%; width: 75%;
    height: 100vh; background: var(--bg);
    flex-direction: column; padding: 100px 32px; gap: 8px;
    transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: -8px 0 30px rgba(0,0,0,0.15); z-index: 1000;
  }
  nav.open { right: 0; }
  nav a { font-size: 1.1rem; padding: 12px 20px; }
  nav a::before { display: none; }
}
</style>
