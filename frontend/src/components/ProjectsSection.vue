<script setup>
import { useScrollReveal } from '../composables/useScrollReveal'
import { projects } from '../data/portfolio'
import { useRouter } from 'vue-router'

useScrollReveal()
const router = useRouter()
const openProject = (id) => router.push({ name: 'ProjectDetail', params: { id } })
</script>

<template>
  <section id="projects" class="projects">
    <div class="container">
      <div class="section-header reveal">
        <h2>Featured Projects</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Some of my recent works</p>
      </div>
      <div class="projects-grid">
        <div v-for="(project, i) in projects" :key="project.id" class="project-card reveal" :style="{ transitionDelay: `${i * 0.1}s` }" @click="openProject(project.id)">
          <div class="project-image">
            <img :src="project.image" :alt="project.title" loading="lazy" />
            <div class="project-overlay"><span>View Details</span></div>
          </div>
          <div class="project-info">
            <h3>{{ project.title }}</h3>
            <p>{{ project.description }}</p>
            <div class="project-tags">
              <span v-for="tag in project.tags" :key="tag" class="tag">{{ tag }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.projects { padding: 100px 0; background: var(--bg-alt); }
.section-subtitle { color: var(--text-light); margin-top: 8px; }
.projects-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-top: 48px; }
.project-card {
  background: var(--bg); border-radius: 12px; overflow: hidden;
  border: 1px solid var(--border); cursor: pointer;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.project-card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 20px 40px rgba(108, 99, 255, 0.15);
  border-color: var(--primary);
}
.project-image { position: relative; overflow: hidden; aspect-ratio: 16/10; }
.project-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
.project-card:hover .project-image img { transform: scale(1.1); }
.project-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(108, 99, 255, 0.9), rgba(90, 82, 213, 0.9));
  display: flex; align-items: center; justify-content: center;
  opacity: 0; transition: opacity 0.4s ease;
}
.project-card:hover .project-overlay { opacity: 1; }
.project-overlay span {
  color: #fff; font-weight: 600; padding: 10px 24px;
  border: 2px solid #fff; border-radius: 8px;
  transform: translateY(20px); transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.project-card:hover .project-overlay span { transform: translateY(0); }
.project-info { padding: 24px; }
.project-info h3 { font-size: 1.2rem; margin-bottom: 8px; color: var(--text-h); }
.project-info p { font-size: 0.9rem; color: var(--text-light); line-height: 1.6; margin-bottom: 16px; }
.project-tags { display: flex; gap: 6px; flex-wrap: wrap; }
.tag {
  padding: 4px 10px; background: var(--tag-bg); color: var(--primary);
  border-radius: 4px; font-size: 0.8rem; font-weight: 500;
  transition: all 0.3s ease;
}
.project-card:hover .tag { background: var(--primary); color: #fff; }
@media (max-width: 1024px) { .projects-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) { .projects-grid { grid-template-columns: 1fr; } }
</style>
