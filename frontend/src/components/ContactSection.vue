<script setup>
import { ref } from 'vue'
import { useScrollReveal } from '../composables/useScrollReveal'
import { personalInfo } from '../data/portfolio'
import axios from 'axios'

useScrollReveal()

const form = ref({ name: '', email: '', subject: '', message: '' })
const status = ref('')
const isLoading = ref(false)

const submitForm = async () => {
  isLoading.value = true
  status.value = ''
  try {
    await axios.post('/api/contact', form.value)
    status.value = 'success'
    form.value = { name: '', email: '', subject: '', message: '' }
  } catch {
    status.value = 'error'
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <section id="contact" class="contact">
    <div class="container">
      <div class="section-header reveal">
        <h2>Get In Touch</h2>
        <div class="divider"></div>
        <p class="section-subtitle">Have a project in mind? Let's talk about it.</p>
      </div>
      <div class="contact-content">
        <div class="contact-info reveal">
          <h3>Contact Information</h3>
          <p>Feel free to reach out. I'm always open to new opportunities and collaborations.</p>
          <div class="contact-details">
            <div class="contact-item">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <span>{{ personalInfo.email }}</span>
            </div>
            <div class="contact-item">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
              <span>{{ personalInfo.phone }}</span>
            </div>
            <div class="contact-item">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>{{ personalInfo.location }}</span>
            </div>
          </div>
        </div>
        <form class="contact-form reveal" @submit.prevent="submitForm">
          <div class="form-row">
            <div class="input-group">
              <input v-model="form.name" type="text" placeholder=" " required />
              <label>Your Name</label>
            </div>
            <div class="input-group">
              <input v-model="form.email" type="email" placeholder=" " required />
              <label>Your Email</label>
            </div>
          </div>
          <div class="input-group">
            <input v-model="form.subject" type="text" placeholder=" " required />
            <label>Subject</label>
          </div>
          <div class="input-group">
            <textarea v-model="form.message" placeholder=" " rows="5" required></textarea>
            <label>Your Message</label>
          </div>
          <button type="submit" class="btn btn-primary btn-pulse" :disabled="isLoading">
            <span class="btn-text">{{ isLoading ? 'Sending...' : 'Send Message' }}</span>
            <span class="btn-icon" v-if="!isLoading">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </span>
            <span class="btn-spinner" v-if="isLoading"></span>
          </button>
          <p v-if="status === 'success'" class="form-success">Message sent successfully!</p>
          <p v-if="status === 'error'" class="form-error">Failed to send. Please try again.</p>
        </form>
      </div>
    </div>
  </section>
</template>

<style scoped>
.contact { padding: 100px 0; }
.section-subtitle { color: var(--text-light); margin-top: 8px; }
.contact-content { display: grid; grid-template-columns: 1fr 1.5fr; gap: 60px; margin-top: 48px; }
.contact-info h3 { font-size: 1.5rem; margin-bottom: 16px; color: var(--text-h); }
.contact-info p { color: var(--text-light); line-height: 1.7; margin-bottom: 32px; }
.contact-details { display: flex; flex-direction: column; gap: 20px; }
.contact-item { display: flex; align-items: center; gap: 12px; color: var(--text-light); }
.contact-item svg { color: var(--primary); flex-shrink: 0; }

.contact-form { display: flex; flex-direction: column; gap: 20px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

.input-group { position: relative; }
.input-group input, .input-group textarea {
  width: 100%; padding: 18px 16px 6px; border: 2px solid var(--border);
  border-radius: 8px; font-size: 1rem; font-family: inherit;
  background: var(--bg); color: var(--text-h);
  transition: border-color 0.3s ease; box-sizing: border-box;
  outline: none;
}
.input-group textarea { padding-top: 22px; resize: vertical; min-height: 120px; }
.input-group label {
  position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
  color: var(--text-light); font-size: 1rem; pointer-events: none;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  background: var(--bg); padding: 0 4px;
}
.input-group textarea ~ label { top: 22px; transform: none; }
.input-group input:focus ~ label,
.input-group input:not(:placeholder-shown) ~ label,
.input-group textarea:focus ~ label,
.input-group textarea:not(:placeholder-shown) ~ label {
  top: 8px; font-size: 0.75rem; color: var(--primary);
}
.input-group input:focus, .input-group textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-bg); }

.btn {
  display: inline-flex; align-items: center; justify-content: center;
  gap: 8px; padding: 14px 32px; border-radius: 8px; font-size: 1rem;
  font-weight: 600; text-decoration: none; cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: none; font-family: inherit; position: relative; overflow: hidden;
}
.btn-primary { background: var(--primary); color: #fff; }
.btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(108, 99, 255, 0.4); }
.btn-primary:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

.btn-spinner {
  width: 20px; height: 20px; border: 2px solid rgba(255,255,255,0.3);
  border-top-color: #fff; border-radius: 50%; animation: spin 0.6s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

.form-success { color: #10b981; font-weight: 500; animation: slideUp 0.3s ease; }
.form-error { color: #ef4444; font-weight: 500; animation: slideUp 0.3s ease; }
@keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

@media (max-width: 768px) {
  .contact-content { grid-template-columns: 1fr; }
  .form-row { grid-template-columns: 1fr; }
}
</style>
