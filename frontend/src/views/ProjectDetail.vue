<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import NavBar from '../components/NavBar.vue'
import FooterSection from '../components/FooterSection.vue'
import { projects } from '../data/portfolio'

const route = useRoute()
const router = useRouter()
const project = ref(null)

onMounted(() => {
  const found = projects.find(p => p.id === route.params.id)
  if (found) {
    project.value = found
  } else {
    router.push('/')
  }
})
</script>

<template>
  <NavBar />
  <section class="project-detail" v-if="project">
    <div class="container">
      <button class="back-btn" @click="router.push('/')">&larr; Kembali</button>
      <div class="project-header">
        <h1>{{ project.title }}</h1>
        <div class="project-tags">
          <span v-for="tag in project.tags" :key="tag" class="tag">{{ tag }}</span>
        </div>
      </div>
      <div class="project-content">
        <img :src="project.image" :alt="project.title" class="project-image" />
        <div class="project-description">
          <p>{{ project.description }}</p>
          <p>{{ project.longDescription }}</p>
        </div>
      </div>
      <div class="project-links">
        <a :href="project.demoUrl" target="_blank" class="btn btn-primary" v-if="project.demoUrl">Live Demo</a>
        <a :href="project.sourceUrl" target="_blank" class="btn btn-secondary" v-if="project.sourceUrl">Source Code</a>
      </div>
    </div>
  </section>
  <FooterSection />
</template>

<style scoped>
.project-detail {
  padding: 120px 0 60px;
  min-height: 100vh;
}
.back-btn {
  background: none;
  border: 2px solid var(--border);
  padding: 10px 24px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  color: var(--text);
  margin-bottom: 32px;
  transition: all 0.3s;
}
.back-btn:hover {
  border-color: var(--primary);
  color: var(--primary);
}
.project-header {
  margin-bottom: 40px;
}
.project-header h1 {
  font-size: 2.5rem;
  margin-bottom: 16px;
}
.project-tags {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}
.tag {
  padding: 6px 14px;
  background: var(--tag-bg);
  color: var(--primary);
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 500;
}
.project-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  margin-bottom: 40px;
}
.project-image {
  width: 100%;
  border-radius: 12px;
  box-shadow: var(--shadow);
}
.project-description p {
  margin-bottom: 16px;
  line-height: 1.8;
  color: var(--text-light);
}
.project-links {
  display: flex;
  gap: 16px;
}
@media (max-width: 768px) {
  .project-content {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}
</style>
