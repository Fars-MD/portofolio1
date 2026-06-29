<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const canvasRef = ref(null)
let animationId = null
let particles = []

class Particle {
  constructor(w, h) {
    this.reset(w, h, true)
  }

  reset(w, h, initial = false) {
    this.x = Math.random() * w
    this.y = initial ? Math.random() * h : -10
    this.size = Math.random() * 3 + 1
    this.speedY = Math.random() * 0.5 + 0.2
    this.speedX = (Math.random() - 0.5) * 0.3
    this.opacity = Math.random() * 0.5 + 0.2
    this.hue = Math.random() * 60 + 240
  }

  update(w, h) {
    this.y += this.speedY
    this.x += this.speedX
    if (this.y > h + 10) this.reset(w, h)
    if (this.x < -10) this.x = w + 10
    if (this.x > w + 10) this.x = -10
  }

  draw(ctx) {
    ctx.beginPath()
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2)
    ctx.fillStyle = `hsla(${this.hue}, 70%, 65%, ${this.opacity})`
    ctx.fill()
  }
}

function connectParticles(ctx, particles, w, h) {
  for (let i = 0; i < particles.length; i++) {
    for (let j = i + 1; j < particles.length; j++) {
      const dx = particles[i].x - particles[j].x
      const dy = particles[i].y - particles[j].y
      const dist = Math.sqrt(dx * dx + dy * dy)
      if (dist < 120) {
        ctx.beginPath()
        ctx.moveTo(particles[i].x, particles[i].y)
        ctx.lineTo(particles[j].x, particles[j].y)
        ctx.strokeStyle = `hsla(250, 70%, 65%, ${0.1 * (1 - dist / 120)})`
        ctx.lineWidth = 0.5
        ctx.stroke()
      }
    }
  }
}

onMounted(() => {
  const canvas = canvasRef.value
  if (!canvas) return
  const ctx = canvas.getContext('2d')
  let w = (canvas.width = window.innerWidth)
  let h = (canvas.height = window.innerHeight)

  const count = Math.min(Math.floor((w * h) / 15000), 80)
  particles = Array.from({ length: count }, () => new Particle(w, h))

  function animate() {
    ctx.clearRect(0, 0, w, h)
    particles.forEach((p) => {
      p.update(w, h)
      p.draw(ctx)
    })
    connectParticles(ctx, particles, w, h)
    animationId = requestAnimationFrame(animate)
  }

  animate()

  const handleResize = () => {
    w = canvas.width = window.innerWidth
    h = canvas.height = window.innerHeight
  }
  window.addEventListener('resize', handleResize)

  onUnmounted(() => {
    cancelAnimationFrame(animationId)
    window.removeEventListener('resize', handleResize)
  })
})
</script>

<template>
  <canvas ref="canvasRef" class="particles-canvas"></canvas>
</template>

<style scoped>
.particles-canvas {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 0;
}
</style>
