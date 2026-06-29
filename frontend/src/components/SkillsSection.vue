<script setup>
import { ref } from 'vue'
import { useScrollReveal } from '../composables/useScrollReveal'
import { skills } from '../data/portfolio'

useScrollReveal()

const activeCategory = ref('all')
const categories = [
  { key: 'all', label: 'All' },
  { key: 'frontend', label: 'Frontend' },
  { key: 'backend', label: 'Backend' },
  { key: 'tools', label: 'Tools' },
]
const filteredSkills = ref(skills)

const filterSkills = (category) => {
  activeCategory.value = category
  filteredSkills.value = category === 'all' ? skills : skills.filter(s => s.category === category)
}
</script>

<template>
  <section id="skills" class="skills">
    <div class="container">
      <div class="section-header reveal">
        <h2>Skills & Expertise</h2>
        <div class="divider"></div>
      </div>
      <div class="skills-filter reveal">
        <button v-for="cat in categories" :key="cat.key" :class="{ active: activeCategory === cat.key }" @click="filterSkills(cat.key)">
          {{ cat.label }}
        </button>
      </div>
      <div class="skills-grid">
        <div v-for="(skill, i) in filteredSkills" :key="skill.name" class="skill-card reveal" :style="{ transitionDelay: `${i * 0.05}s` }">
          <div class="skill-header">
            <span class="skill-name">{{ skill.name }}</span>
            <span class="skill-level">{{ skill.level }}%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" :style="{ '--level': skill.level + '%' }"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.skills { padding: 100px 0; }
.skills-filter { display: flex; justify-content: center; gap: 12px; margin-bottom: 48px; }
.skills-filter button {
  padding: 10px 24px; border: 2px solid var(--border); background: transparent;
  border-radius: 8px; cursor: pointer; font-size: 0.95rem; font-weight: 500;
  color: var(--text-light); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative; overflow: hidden;
}
.skills-filter button::after {
  content: ''; position: absolute; inset: 0; border-radius: 6px;
  background: var(--primary); opacity: 0; transform: scale(0);
  transition: all 0.3s ease; z-index: -1;
}
.skills-filter button.active::after, .skills-filter button:hover::after {
  opacity: 0.1; transform: scale(1);
}
.skills-filter button.active, .skills-filter button:hover {
  border-color: var(--primary); color: var(--primary);
}
.skills-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; max-width: 800px; margin: 0 auto; }
.skill-card {
  padding: 20px 24px; border: 1px solid var(--border); border-radius: 10px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.skill-card:hover { transform: translateY(-4px); box-shadow: var(--shadow); border-color: var(--primary); }
.skill-header { display: flex; justify-content: space-between; margin-bottom: 12px; }
.skill-name { font-weight: 600; color: var(--text-h); }
.skill-level { color: var(--primary); font-weight: 600; }
.progress-bar { height: 8px; background: var(--border); border-radius: 4px; overflow: hidden; }
.progress-fill {
  height: 100%; width: 0;
  background: linear-gradient(90deg, var(--primary), var(--primary-dark));
  border-radius: 4px;
  transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
}
.revealed .progress-fill { width: var(--level); }
@media (max-width: 768px) { .skills-grid { grid-template-columns: 1fr; } }
</style>
