<!doctype html>
<html lang="en" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio Builder Pro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <script src="/_sdk/data_sdk.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&amp;family=DM+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
  <style>
    body { box-sizing: border-box; font-family: 'DM Sans', sans-serif; }

    :root {
      --bg: #0a0a0f;
      --surface: #14141f;
      --text: #e8e6f0;
      --primary: #6c5ce7;
      --secondary: #00cec9;
    }

    .portfolio-bg {
      background: var(--bg);
      background-image:
        radial-gradient(ellipse 80% 60% at 50% 0%, rgba(108,92,231,0.12) 0%, transparent 60%),
        radial-gradient(ellipse 60% 40% at 80% 100%, rgba(0,206,201,0.08) 0%, transparent 50%);
    }

    .glass-card {
      background: rgba(20,20,31,0.7);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(108,92,231,0.15);
      transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .glass-card:hover {
      border-color: rgba(108,92,231,0.4);
      transform: translateY(-4px);
      box-shadow: 0 20px 60px rgba(108,92,231,0.15);
    }

    .hero-glow {
      position: relative;
    }
    .hero-glow::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 500px;
      height: 500px;
      transform: translate(-50%, -50%);
      background: radial-gradient(circle, rgba(108,92,231,0.2) 0%, transparent 70%);
      border-radius: 50%;
      animation: pulse-glow 4s ease-in-out infinite;
      pointer-events: none;
    }

    @keyframes pulse-glow {
      0%, 100% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); }
      50% { opacity: 1; transform: translate(-50%, -50%) scale(1.2); }
    }

    @keyframes float-in {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slide-right {
      from { opacity: 0; transform: translateX(-40px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes morph-blob {
      0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
      50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
    }

    .animate-float { animation: float-in 0.7s ease-out both; }
    .animate-slide { animation: slide-right 0.6s ease-out both; }

    .blob-shape {
      animation: morph-blob 8s ease-in-out infinite;
    }

    .grid-pattern {
      background-image:
        linear-gradient(rgba(108,92,231,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(108,92,231,0.04) 1px, transparent 1px);
      background-size: 40px 40px;
    }

    .tag-pill {
      background: rgba(108,92,231,0.15);
      border: 1px solid rgba(108,92,231,0.25);
      color: var(--primary);
      transition: all 0.3s ease;
    }
    .tag-pill:hover {
      background: rgba(108,92,231,0.3);
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary), #8b7cf7);
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      box-shadow: 0 8px 30px rgba(108,92,231,0.4);
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: rgba(0,206,201,0.1);
      border: 1px solid rgba(0,206,201,0.3);
      color: var(--secondary);
      transition: all 0.3s ease;
    }
    .btn-secondary:hover {
      background: rgba(0,206,201,0.2);
      transform: translateY(-1px);
    }

    .modal-overlay {
      background: rgba(5,5,10,0.85);
      backdrop-filter: blur(8px);
    }

    .input-field {
      background: rgba(20,20,31,0.8);
      border: 1px solid rgba(108,92,231,0.2);
      color: var(--text);
      transition: border-color 0.3s ease;
    }
    .input-field:focus {
      border-color: var(--primary);
      outline: none;
      box-shadow: 0 0 0 3px rgba(108,92,231,0.15);
    }

    .nav-link {
      position: relative;
      color: rgba(232,230,240,0.6);
      transition: color 0.3s ease;
      cursor: pointer;
    }
    .nav-link:hover, .nav-link.active {
      color: var(--text);
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary);
      transition: width 0.3s ease;
    }
    .nav-link:hover::after, .nav-link.active::after {
      width: 100%;
    }

    .icon-grid-item {
      cursor: pointer;
      transition: all 0.2s ease;
      border: 2px solid transparent;
      border-radius: 10px;
      padding: 8px;
    }
    .icon-grid-item:hover {
      background: rgba(108,92,231,0.1);
    }
    .icon-grid-item.selected {
      border-color: var(--primary);
      background: rgba(108,92,231,0.15);
    }

    .color-swatch {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      cursor: pointer;
      border: 3px solid transparent;
      transition: all 0.2s ease;
    }
    .color-swatch:hover { transform: scale(1.15); }
    .color-swatch.selected { border-color: white; box-shadow: 0 0 12px rgba(255,255,255,0.3); }

    .section-divider {
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(108,92,231,0.3), transparent);
    }

    .avatar-blob {
      width: 120px;
      height: 120px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 48px;
      font-weight: 800;
      color: white;
      animation: morph-blob 8s ease-in-out infinite;
    }

    .preview-mode .edit-controls { display: none; }
    .edit-mode .preview-badge { display: none; }

    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg); }
    ::-webkit-scrollbar-thumb { background: rgba(108,92,231,0.3); border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(108,92,231,0.5); }

    .skill-bar {
      height: 6px;
      border-radius: 3px;
      background: rgba(108,92,231,0.15);
      overflow: hidden;
    }
    .skill-bar-fill {
      height: 100%;
      border-radius: 3px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      transition: width 1s ease-out;
    }

    .orbit-ring {
      border: 1px dashed rgba(108,92,231,0.15);
      border-radius: 50%;
      position: absolute;
      animation: spin-slow 20s linear infinite;
    }
    @keyframes spin-slow {
      from { transform: translate(-50%, -50%) rotate(0deg); }
      to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .particle {
      position: absolute;
      width: 3px;
      height: 3px;
      border-radius: 50%;
      background: var(--primary);
      opacity: 0.4;
      animation: particle-float 6s ease-in-out infinite;
    }
    @keyframes particle-float {
      0%, 100% { transform: translateY(0) translateX(0); opacity: 0.4; }
      50% { transform: translateY(-20px) translateX(10px); opacity: 0.8; }
    }

    .delete-confirm {
      background: rgba(239,68,68,0.15);
      border: 1px solid rgba(239,68,68,0.4);
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      opacity: 0.5;
    }

    .placeholder-text {
      opacity: 0.4;
      font-style: italic;
    }

    .toast-notification {
      animation: toast-in 0.4s ease-out, toast-out 0.4s ease-in 2.6s;
    }
    @keyframes toast-in {
      from { opacity: 0; transform: translateY(20px) scale(0.95); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes toast-out {
      from { opacity: 1; }
      to { opacity: 0; transform: translateY(-10px); }
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
 </head>
 <body class="h-full">
  <div id="app" class="h-full w-full portfolio-bg grid-pattern overflow-auto" style="color: var(--text);"><!-- Toast Container -->
   <div id="toast-container" class="fixed top-4 right-4 z-50 flex flex-col gap-2"></div><!-- Onboarding Form Overlay -->
   <div id="onboarding-overlay" class="fixed inset-0 z-50 modal-overlay flex items-center justify-center p-4" style="display: flex;">
    <div id="onboarding-content" class="glass-card rounded-2xl p-8 w-full max-w-md" style="border-color: rgba(108,92,231,0.3);">
     <div class="text-center mb-8">
      <div class="text-5xl mb-3">
       ✨
      </div>
      <h2 class="text-2xl font-bold" style="font-family: 'Sora', sans-serif;">Welcome to Your Portfolio</h2>
      <p class="text-sm opacity-50 mt-2">Let's get you set up in 30 seconds</p>
     </div>
     <form id="onboarding-form" onsubmit="handleOnboardingSubmit(event)">
      <div class="flex flex-col gap-4">
       <div><label for="onboard-name" class="block text-sm font-medium mb-2 opacity-70">Your Full Name *</label> <input id="onboard-name" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="Jane Doe" required>
       </div>
       <div><label for="onboard-title" class="block text-sm font-medium mb-2 opacity-70">Professional Title *</label> <input id="onboard-title" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="Creative Developer &amp; Designer" required>
       </div>
       <div><label for="onboard-bio" class="block text-sm font-medium mb-2 opacity-70">About You</label> <textarea id="onboard-bio" class="input-field w-full px-4 py-3 rounded-xl text-sm" rows="3" placeholder="Write a brief introduction..."></textarea>
       </div>
       <div><label for="onboard-email" class="block text-sm font-medium mb-2 opacity-70">Email Address *</label> <input id="onboard-email" type="email" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="your.email@example.com" required>
       </div><button type="submit" id="onboard-submit-btn" class="btn-primary w-full py-3 rounded-xl text-white font-semibold text-sm mt-2"> Create My Portfolio </button>
      </div>
     </form>
     <p class="text-xs text-center opacity-30 mt-4">You can edit these details later in the edit panel</p>
    </div>
   </div><!-- Navigation -->
   <nav id="main-nav" class="sticky top-0 z-40 w-full" style="background: rgba(10,10,15,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(108,92,231,0.1);">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
     <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white;">
       P
      </div><span id="nav-name" class="font-semibold text-lg placeholder-text" style="font-family: 'Sora', sans-serif;">Your Name</span>
     </div>
     <div class="flex items-center gap-6"><a href="#hero" class="nav-link text-sm font-medium active">Home</a> <a href="#projects" class="nav-link text-sm font-medium">Work</a> <a href="#skills" class="nav-link text-sm font-medium">Skills</a> <a href="#contact" class="nav-link text-sm font-medium">Contact</a> <button id="toggle-mode-btn" class="btn-secondary text-xs px-3 py-1.5 rounded-full font-medium edit-controls" onclick="togglePreviewMode()"> 👁 Preview </button>
     </div>
    </div>
   </nav><!-- Hero Section -->
   <section id="hero" class="relative w-full py-24 px-6 overflow-hidden"><!-- Decorative elements -->
    <div class="orbit-ring" style="width: 400px; height: 400px; top: 50%; left: 50%;"></div>
    <div class="orbit-ring" style="width: 600px; height: 600px; top: 50%; left: 50%; animation-duration: 30s; animation-direction: reverse;"></div>
    <div class="particle" style="top: 20%; left: 15%;"></div>
    <div class="particle" style="top: 60%; left: 80%; animation-delay: 2s;"></div>
    <div class="particle" style="top: 40%; left: 60%; animation-delay: 4s;"></div>
    <div class="particle" style="top: 75%; left: 25%; animation-delay: 1s;"></div>
    <div class="hero-glow max-w-4xl mx-auto text-center relative z-10">
     <div class="animate-float" style="animation-delay: 0.1s;">
      <div id="hero-avatar" class="avatar-blob mx-auto mb-8">
       Y
      </div>
     </div>
     <h1 id="hero-name" class="animate-float text-5xl md:text-7xl font-extrabold mb-4 placeholder-text" style="font-family: 'Sora', sans-serif; animation-delay: 0.2s; line-height: 1.1;">Your Full Name Here</h1>
     <p id="hero-tagline" class="animate-float text-xl md:text-2xl font-light mb-6 placeholder-text" style="animation-delay: 0.3s;">Your Professional Title</p>
     <p id="hero-desc" class="animate-float text-base max-w-2xl mx-auto mb-10 placeholder-text leading-relaxed" style="animation-delay: 0.4s;">Add a brief introduction about yourself through the edit panel</p>
     <div class="animate-float flex gap-4 justify-center" style="animation-delay: 0.5s;"><a href="#projects" class="btn-primary px-8 py-3 rounded-full text-white font-semibold text-sm inline-block">View My Work</a> <a href="#contact" class="btn-secondary px-8 py-3 rounded-full font-semibold text-sm inline-block">Get in Touch</a>
     </div>
    </div>
   </section>
   <div class="section-divider w-full"></div><!-- Projects Section -->
   <section id="projects" class="w-full py-20 px-6">
    <div class="max-w-6xl mx-auto">
     <div class="flex items-center justify-between mb-12">
      <div>
       <h2 class="text-3xl md:text-4xl font-bold" style="font-family: 'Sora', sans-serif;">Featured Work</h2>
       <p class="opacity-50 mt-2 text-sm">Showcase your best projects</p>
      </div><button id="add-project-btn" class="btn-primary px-5 py-2.5 rounded-xl text-white font-medium text-sm edit-controls" onclick="openModal('project')"> + Add Project </button>
     </div>
     <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"><!-- Projects populated by user -->
     </div>
     <div id="projects-empty" class="empty-state">
      <div class="text-5xl mb-4">
       🎨
      </div>
      <p class="text-lg font-medium">Start Adding Your Projects</p>
      <p class="text-sm mt-1 edit-controls">Click "+ Add Project" to showcase your work</p>
      <p class="text-sm mt-3 preview-badge">No projects added yet. Switch to edit mode to add content.</p>
     </div>
    </div>
   </section>
   <div class="section-divider w-full"></div><!-- Skills Section -->
   <section id="skills" class="w-full py-20 px-6">
    <div class="max-w-6xl mx-auto">
     <div class="flex items-center justify-between mb-12">
      <div>
       <h2 class="text-3xl md:text-4xl font-bold" style="font-family: 'Sora', sans-serif;">Expertise</h2>
       <p class="opacity-50 mt-2 text-sm">Highlight your skills &amp; tools</p>
      </div><button id="add-skill-btn" class="btn-secondary px-5 py-2.5 rounded-xl font-medium text-sm edit-controls" onclick="openModal('skill')"> + Add Skill </button>
     </div>
     <div id="skills-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5"><!-- Skills populated by user -->
     </div>
     <div id="skills-empty" class="empty-state">
      <div class="text-5xl mb-4">
       ⚡
      </div>
      <p class="text-lg font-medium">Build Your Skills List</p>
      <p class="text-sm mt-1 edit-controls">Click "+ Add Skill" to highlight your expertise</p>
      <p class="text-sm mt-3 preview-badge">No skills added yet. Switch to edit mode to add content.</p>
     </div>
    </div>
   </section>
   <div class="section-divider w-full"></div><!-- Contact Section -->
   <section id="contact" class="w-full py-20 px-6">
    <div class="max-w-2xl mx-auto text-center">
     <h2 class="text-3xl md:text-4xl font-bold mb-4" style="font-family: 'Sora', sans-serif;">Let's Connect</h2>
     <p class="opacity-50 mb-10">Have a project in mind? Let's work together.</p>
     <div class="glass-card rounded-2xl p-8 text-left">
      <div class="flex items-center gap-4 mb-6">
       <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background: rgba(108,92,231,0.15);">
        ✉️
       </div>
       <div>
        <p class="text-sm opacity-50">Email</p>
        <p id="contact-email-display" class="font-semibold placeholder-text">your.email@example.com</p>
       </div>
      </div>
      <div class="section-divider mb-6"></div>
      <p class="text-sm opacity-40">Built with Portfolio Builder Pro ✨</p>
     </div>
    </div>
   </section><!-- Footer -->
   <footer class="w-full py-8 px-6 text-center" style="border-top: 1px solid rgba(108,92,231,0.1);">
    <p id="footer-text-el" class="text-sm opacity-40 placeholder-text">© 2024 Your Name. All rights reserved.</p>
   </footer><!-- Modal -->
   <div id="modal-overlay" class="fixed inset-0 z-50 modal-overlay hidden items-center justify-center p-4" style="display: none;">
    <div id="modal-content" class="glass-card rounded-2xl p-6 w-full max-w-lg max-h-[90%] overflow-y-auto" style="border-color: rgba(108,92,231,0.3);">
     <div class="flex items-center justify-between mb-6">
      <h3 id="modal-title" class="text-xl font-bold" style="font-family: 'Sora', sans-serif;">Add Project</h3><button onclick="closeModal()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors text-lg">✕</button>
     </div>
     <form id="modal-form" onsubmit="handleFormSubmit(event)">
      <div id="modal-fields" class="flex flex-col gap-4"><!-- Dynamic fields -->
      </div><!-- Icon Picker -->
      <div id="icon-picker-section" class="mt-5"><label class="block text-sm font-medium mb-2 opacity-70">Choose an Icon</label>
       <div id="icon-grid" class="grid grid-cols-8 gap-1 p-3 rounded-xl" style="background: rgba(10,10,15,0.5);">
       </div>
      </div><!-- Color Picker -->
      <div id="color-picker-section" class="mt-5"><label class="block text-sm font-medium mb-2 opacity-70">Accent Color</label>
       <div id="color-grid" class="flex gap-2 flex-wrap p-3 rounded-xl" style="background: rgba(10,10,15,0.5);">
       </div>
      </div>
      <div class="flex gap-3 mt-6"><button type="submit" id="modal-submit-btn" class="btn-primary flex-1 py-3 rounded-xl text-white font-semibold text-sm"> Save </button> <button type="button" onclick="closeModal()" class="btn-secondary flex-1 py-3 rounded-xl font-semibold text-sm"> Cancel </button>
      </div>
     </form>
    </div>
   </div>
  </div>
  <script>
// ===== State =====
let allData = [];
let currentModalType = null;
let editingRecord = null;
let selectedIcon = '🚀';
let selectedColor = '#6c5ce7';
let isPreviewMode = false;
let deleteConfirmId = null;

const ICONS_PROJECT = ['🚀','🎨','💻','🌐','📱','🎮','📊','🛒','📸','🎬','🤖','🧠','📝','🔧','🏗️','✨','🎯','💡','🔥','🌟','📐','🧩','🎵','📈'];
const ICONS_SKILL = ['⚡','🎯','💎','🔮','🧪','🏆','��','🎓','🔬','💪','🧰','🌈','🎲','🔑','🛡️','🚀','💻','🎨','📊','🌐','🤖','📱','🔧','✏️'];
const COLORS = ['#6c5ce7','#00cec9','#fd79a8','#fdcb6e','#00b894','#e17055','#74b9ff','#a29bfe','#55efc4','#fab1a0','#81ecec','#ffeaa7'];

const defaultConfig = {
  portfolio_name: '',
  portfolio_tagline: '',
  hero_description: '',
  contact_email: '',
  footer_text: '',
  background_color: '#0a0a0f',
  surface_color: '#14141f',
  text_color: '#e8e6f0',
  primary_color: '#6c5ce7',
  secondary_color: '#00cec9',
  font_family: 'Sora',
  font_size: 16
};

// ===== Toast Notification =====
function showToast(message, type = 'success') {
  const container = document.getElementById('toast-container');
  const toast = document.createElement('div');
  const icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
  const bg = type === 'success' ? 'rgba(0,184,148,0.9)' : type === 'error' ? 'rgba(239,68,68,0.9)' : 'rgba(108,92,231,0.9)';
  toast.className = 'toast-notification px-4 py-3 rounded-xl text-white text-sm font-medium flex items-center gap-2';
  toast.style.cssText = `background:${bg}; backdrop-filter:blur(8px); min-width:200px;`;
  toast.innerHTML = `<span>${icon}</span> ${message}`;
  container.appendChild(toast);
  setTimeout(() => toast.remove(), 3000);
}

// ===== Onboarding Form =====
function showOnboarding() {
  const overlay = document.getElementById('onboarding-overlay');
  overlay.style.display = 'flex';
}

function hideOnboarding() {
  const overlay = document.getElementById('onboarding-overlay');
  overlay.style.display = 'none';
}

async function handleOnboardingSubmit(e) {
  e.preventDefault();
  const submitBtn = document.getElementById('onboard-submit-btn');
  submitBtn.disabled = true;
  submitBtn.textContent = 'Creating...';

  const name = document.getElementById('onboard-name').value.trim();
  const title = document.getElementById('onboard-title').value.trim();
  const bio = document.getElementById('onboard-bio').value.trim();
  const email = document.getElementById('onboard-email').value.trim();

  if (!name || !title || !email) {
    showToast('Please fill in all required fields', 'error');
    submitBtn.disabled = false;
    submitBtn.textContent = 'Create My Portfolio';
    return;
  }

  // Update config with the entered details
  if (window.elementSdk) {
    await window.elementSdk.setConfig({
      portfolio_name: name,
      portfolio_tagline: title,
      hero_description: bio,
      contact_email: email
    });
    // Apply config immediately to display changes
    applyConfig(window.elementSdk.config);
  }

  showToast('Portfolio created! Add your projects and skills now 🎉', 'success');
  hideOnboarding();
  submitBtn.disabled = false;
  submitBtn.textContent = 'Create My Portfolio';
}

// ===== Preview Mode =====
function togglePreviewMode() {
  isPreviewMode = !isPreviewMode;
  const app = document.getElementById('app');
  const btn = document.getElementById('toggle-mode-btn');
  if (isPreviewMode) {
    app.classList.add('preview-mode');
    app.classList.remove('edit-mode');
    btn.innerHTML = '✏️ Edit';
    btn.className = 'btn-primary text-xs px-3 py-1.5 rounded-full font-medium text-white edit-controls';
    showToast('Preview mode — see how visitors will see your portfolio', 'info');
  } else {
    app.classList.remove('preview-mode');
    app.classList.add('edit-mode');
    btn.innerHTML = '👁 Preview';
    btn.className = 'btn-secondary text-xs px-3 py-1.5 rounded-full font-medium';
  }
}

// ===== Modal =====
function openModal(type, record = null) {
  currentModalType = type;
  editingRecord = record;
  const overlay = document.getElementById('modal-overlay');
  const title = document.getElementById('modal-title');
  const fields = document.getElementById('modal-fields');
  const iconSection = document.getElementById('icon-picker-section');
  const colorSection = document.getElementById('color-picker-section');

  if (type === 'project') {
    title.textContent = record ? 'Edit Project' : 'Add Project';
    selectedIcon = record ? record.icon : '🚀';
    selectedColor = record ? record.color : '#6c5ce7';
    fields.innerHTML = `
      <div>
        <label for="field-title" class="block text-sm font-medium mb-1.5 opacity-70">Project Title *</label>
        <input id="field-title" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="What is this project called?" value="${record ? escapeHTML(record.title) : ''}" required />
      </div>
      <div>
        <label for="field-subtitle" class="block text-sm font-medium mb-1.5 opacity-70">Subtitle</label>
        <input id="field-subtitle" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="e.g. Full-Stack Web App" value="${record ? escapeHTML(record.subtitle) : ''}" />
      </div>
      <div>
        <label for="field-desc" class="block text-sm font-medium mb-1.5 opacity-70">Description</label>
        <textarea id="field-desc" class="input-field w-full px-4 py-3 rounded-xl text-sm" rows="3" placeholder="Tell visitors about this project...">${record ? escapeHTML(record.description) : ''}</textarea>
      </div>
      <div>
        <label for="field-tags" class="block text-sm font-medium mb-1.5 opacity-70">Technologies Used</label>
        <input id="field-tags" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="Separate with commas (React, Node.js, etc)" value="${record ? escapeHTML(record.tags) : ''}" />
      </div>
      <div>
        <label for="field-link" class="block text-sm font-medium mb-1.5 opacity-70">Project URL (optional)</label>
        <input id="field-link" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="https://example.com" value="${record ? escapeHTML(record.link || '') : ''}" />
      </div>
    `;
    renderIconGrid(ICONS_PROJECT);
  } else {
    title.textContent = record ? 'Edit Skill' : 'Add Skill';
    selectedIcon = record ? record.icon : '⚡';
    selectedColor = record ? record.color : '#00cec9';
    fields.innerHTML = `
      <div>
        <label for="field-title" class="block text-sm font-medium mb-1.5 opacity-70">Skill Name *</label>
        <input id="field-title" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="What skill is this?" value="${record ? escapeHTML(record.title) : ''}" required />
      </div>
      <div>
        <label for="field-subtitle" class="block text-sm font-medium mb-1.5 opacity-70">Category</label>
        <input id="field-subtitle" type="text" class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="e.g. Frontend Development" value="${record ? escapeHTML(record.subtitle) : ''}" />
      </div>
      <div>
        <label for="field-desc" class="block text-sm font-medium mb-1.5 opacity-70">Details About This Skill</label>
        <textarea id="field-desc" class="input-field w-full px-4 py-3 rounded-xl text-sm" rows="2" placeholder="Your experience or expertise level...">${record ? escapeHTML(record.description) : ''}</textarea>
      </div>
    `;
    renderIconGrid(ICONS_SKILL);
  }

  iconSection.style.display = 'block';
  colorSection.style.display = 'block';
  renderColorGrid();

  overlay.style.display = 'flex';
  overlay.classList.remove('hidden');
}

function closeModal() {
  const overlay = document.getElementById('modal-overlay');
  overlay.style.display = 'none';
  overlay.classList.add('hidden');
  currentModalType = null;
  editingRecord = null;
}

function renderIconGrid(icons) {
  const grid = document.getElementById('icon-grid');
  grid.innerHTML = icons.map(ic => `
    <div class="icon-grid-item text-center text-xl ${ic === selectedIcon ? 'selected' : ''}" onclick="selectIcon('${ic}', this)">${ic}</div>
  `).join('');
}

function renderColorGrid() {
  const grid = document.getElementById('color-grid');
  grid.innerHTML = COLORS.map(c => `
    <div class="color-swatch ${c === selectedColor ? 'selected' : ''}" style="background:${c};" onclick="selectColor('${c}', this)"></div>
  `).join('');
}

function selectIcon(icon, el) {
  selectedIcon = icon;
  document.querySelectorAll('#icon-grid .icon-grid-item').forEach(e => e.classList.remove('selected'));
  el.classList.add('selected');
}

function selectColor(color, el) {
  selectedColor = color;
  document.querySelectorAll('#color-grid .color-swatch').forEach(e => e.classList.remove('selected'));
  el.classList.add('selected');
}

function escapeHTML(str) {
  if (!str) return '';
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

// ===== Form Submit =====
async function handleFormSubmit(e) {
  e.preventDefault();
  const submitBtn = document.getElementById('modal-submit-btn');
  submitBtn.disabled = true;
  submitBtn.textContent = 'Saving...';

  const title = document.getElementById('field-title').value.trim();
  const subtitle = document.getElementById('field-subtitle')?.value.trim() || '';
  const desc = document.getElementById('field-desc')?.value.trim() || '';
  const tags = document.getElementById('field-tags')?.value.trim() || '';
  const link = document.getElementById('field-link')?.value.trim() || '';

  if (!title) {
    showToast('Please enter a title', 'error');
    submitBtn.disabled = false;
    submitBtn.textContent = 'Save';
    return;
  }

  if (editingRecord) {
    const updated = { ...editingRecord, title, subtitle, description: desc, tags, icon: selectedIcon, color: selectedColor, link };
    const result = await window.dataSdk.update(updated);
    if (result.isOk) {
      showToast(`${currentModalType === 'project' ? 'Project' : 'Skill'} updated!`);
      closeModal();
    } else {
      showToast('Failed to update. Try again.', 'error');
    }
  } else {
    if (allData.length >= 999) {
      showToast('Maximum items reached (999). Delete some first.', 'error');
      submitBtn.disabled = false;
      submitBtn.textContent = 'Save';
      return;
    }
    const record = {
      id: Date.now().toString(36) + Math.random().toString(36).slice(2, 6),
      type: currentModalType,
      title,
      subtitle,
      description: desc,
      tags,
      icon: selectedIcon,
      color: selectedColor,
      link,
      order: allData.filter(d => d.type === currentModalType).length,
      created_at: new Date().toISOString()
    };
    const result = await window.dataSdk.create(record);
    if (result.isOk) {
      showToast(`${currentModalType === 'project' ? 'Project' : 'Skill'} added!`);
      closeModal();
    } else {
      showToast('Failed to save. Try again.', 'error');
    }
  }

  submitBtn.disabled = false;
  submitBtn.textContent = 'Save';
}

// ===== Delete =====
function confirmDelete(record) {
  if (deleteConfirmId === record.id) {
    performDelete(record);
    return;
  }
  deleteConfirmId = record.id;
  const btn = document.querySelector(`[data-delete-id="${record.id}"]`);
  if (btn) {
    btn.innerHTML = 'Confirm?';
    btn.className = 'delete-confirm px-3 py-1 rounded-lg text-xs font-medium text-red-400';
    setTimeout(() => {
      if (deleteConfirmId === record.id) {
        deleteConfirmId = null;
        btn.innerHTML = '🗑';
        btn.className = 'w-8 h-8 rounded-lg flex items-center justify-center hover:bg-red-500/20 transition-colors text-sm opacity-50 hover:opacity-100';
      }
    }, 3000);
  }
}

async function performDelete(record) {
  deleteConfirmId = null;
  const btn = document.querySelector(`[data-delete-id="${record.id}"]`);
  if (btn) { btn.innerHTML = '...'; btn.disabled = true; }
  const result = await window.dataSdk.delete(record);
  if (result.isOk) {
    showToast('Deleted successfully');
  } else {
    showToast('Failed to delete', 'error');
  }
}

// ===== Render Functions =====
function renderProjects(projects) {
  const grid = document.getElementById('projects-grid');
  const empty = document.getElementById('projects-empty');
  const existingMap = new Map([...grid.children].map(el => [el.dataset.itemId, el]));

  if (projects.length === 0) {
    grid.innerHTML = '';
    empty.classList.remove('hidden');
    return;
  }
  empty.classList.add('hidden');

  const sorted = [...projects].sort((a, b) => (a.order || 0) - (b.order || 0));
  const currentIds = new Set(sorted.map(p => p.id));

  existingMap.forEach((el, id) => { if (!currentIds.has(id)) el.remove(); });

  sorted.forEach((project, idx) => {
    const existing = existingMap.get(project.id);
    if (existing) {
      updateProjectCard(existing, project, idx);
    } else {
      const card = createProjectCard(project, idx);
      grid.appendChild(card);
    }
  });
}

function createProjectCard(project, idx) {
  const div = document.createElement('div');
  div.dataset.itemId = project.id;
  div.className = 'glass-card rounded-2xl overflow-hidden animate-float';
  div.style.animationDelay = `${idx * 0.1}s`;
  updateProjectCardInner(div, project);
  return div;
}

function updateProjectCard(el, project) {
  updateProjectCardInner(el, project);
}

function updateProjectCardInner(el, project) {
  const tagsHTML = project.tags ? project.tags.split(',').map(t => `<span class="tag-pill px-2 py-0.5 rounded-full text-xs">${escapeHTML(t.trim())}</span>`).join('') : '';
  const linkHTML = project.link ? `<a href="${escapeHTML(project.link)}" target="_blank" rel="noopener noreferrer" class="btn-secondary px-3 py-1.5 rounded-lg text-xs font-medium inline-flex items-center gap-1">🔗 View</a>` : '';

  el.innerHTML = `
    <div class="h-36 flex items-center justify-center relative" style="background: linear-gradient(135deg, ${project.color}22, ${project.color}08);">
      <div class="text-5xl blob-shape w-20 h-20 flex items-center justify-center" style="background: ${project.color}20;">${project.icon || '🚀'}</div>
      <div class="absolute top-3 right-3 flex gap-1 edit-controls">
        <button onclick='openModal("project", ${escapeAttrJSON(project)})' class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors text-sm opacity-50 hover:opacity-100">✏️</button>
        <button data-delete-id="${project.id}" onclick='confirmDelete(${escapeAttrJSON(project)})' class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-red-500/20 transition-colors text-sm opacity-50 hover:opacity-100">🗑</button>
      </div>
    </div>
    <div class="p-5">
      <h3 class="font-bold text-lg mb-1" style="font-family:'Sora',sans-serif;">${escapeHTML(project.title)}</h3>
      ${project.subtitle ? `<p class="text-sm opacity-50 mb-2">${escapeHTML(project.subtitle)}</p>` : ''}
      ${project.description ? `<p class="text-sm opacity-40 mb-3 leading-relaxed line-clamp-3">${escapeHTML(project.description)}</p>` : ''}
      <div class="flex flex-wrap gap-1.5 mb-3">${tagsHTML}</div>
      ${linkHTML}
    </div>
  `;
}

function escapeAttrJSON(obj) {
  return JSON.stringify(obj).replace(/'/g, "&#39;").replace(/"/g, '&quot;');
}

function renderSkills(skills) {
  const grid = document.getElementById('skills-grid');
  const empty = document.getElementById('skills-empty');
  const existingMap = new Map([...grid.children].map(el => [el.dataset.itemId, el]));

  if (skills.length === 0) {
    grid.innerHTML = '';
    empty.classList.remove('hidden');
    return;
  }
  empty.classList.add('hidden');

  const sorted = [...skills].sort((a, b) => (a.order || 0) - (b.order || 0));
  const currentIds = new Set(sorted.map(s => s.id));

  existingMap.forEach((el, id) => { if (!currentIds.has(id)) el.remove(); });

  sorted.forEach((skill, idx) => {
    const existing = existingMap.get(skill.id);
    if (existing) {
      updateSkillCard(existing, skill, idx);
    } else {
      const card = createSkillCard(skill, idx);
      grid.appendChild(card);
    }
  });
}

function createSkillCard(skill, idx) {
  const div = document.createElement('div');
  div.dataset.itemId = skill.id;
  div.className = 'glass-card rounded-xl p-5 animate-slide';
  div.style.animationDelay = `${idx * 0.08}s`;
  updateSkillCardInner(div, skill);
  return div;
}

function updateSkillCard(el, skill) {
  updateSkillCardInner(el, skill);
}

function updateSkillCardInner(el, skill) {
  el.innerHTML = `
    <div class="flex items-start justify-between mb-3">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-xl" style="background: ${skill.color}20;">${skill.icon || '⚡'}</div>
        <div>
          <h4 class="font-semibold" style="font-family:'Sora',sans-serif;">${escapeHTML(skill.title)}</h4>
          ${skill.subtitle ? `<p class="text-xs opacity-40">${escapeHTML(skill.subtitle)}</p>` : ''}
        </div>
      </div>
      <div class="flex gap-1 edit-controls">
        <button onclick='openModal("skill", ${escapeAttrJSON(skill)})' class="w-7 h-7 rounded-md flex items-center justify-center hover:bg-white/10 transition-colors text-xs opacity-40 hover:opacity-100">✏️</button>
        <button data-delete-id="${skill.id}" onclick='confirmDelete(${escapeAttrJSON(skill)})' class="w-7 h-7 rounded-md flex items-center justify-center hover:bg-red-500/20 transition-colors text-xs opacity-40 hover:opacity-100">🗑</button>
      </div>
    </div>
    ${skill.description ? `<p class="text-sm opacity-40 leading-relaxed">${escapeHTML(skill.description)}</p>` : ''}
    <div class="skill-bar mt-3"><div class="skill-bar-fill" style="width: ${60 + Math.random() * 35}%; background: linear-gradient(90deg, ${skill.color}, ${skill.color}88);"></div></div>
  `;
}

// ===== Data Handler =====
const dataHandler = {
  onDataChanged(data) {
    allData = data;
    const projects = data.filter(d => d.type === 'project');
    const skills = data.filter(d => d.type === 'skill');
    renderProjects(projects);
    renderSkills(skills);

    if (isPreviewMode) {
      document.getElementById('app').classList.add('preview-mode');
    }
  }
};

// ===== Element SDK =====
function applyConfig(config) {
  const c = { ...defaultConfig, ...config };
  const customFont = c.font_family || defaultConfig.font_family;
  const baseSize = c.font_size || defaultConfig.font_size;
  const baseFontStack = "'DM Sans', sans-serif";
  const headingFontStack = `'${customFont}', ${baseFontStack}`;

  document.documentElement.style.setProperty('--bg', c.background_color);
  document.documentElement.style.setProperty('--surface', c.surface_color);
  document.documentElement.style.setProperty('--text', c.text_color);
  document.documentElement.style.setProperty('--primary', c.primary_color);
  document.documentElement.style.setProperty('--secondary', c.secondary_color);

  document.getElementById('app').style.color = c.text_color;

  // Hero section
  const heroName = document.getElementById('hero-name');
  heroName.textContent = c.portfolio_name || 'Your Full Name Here';
  heroName.style.fontFamily = headingFontStack;
  heroName.style.fontSize = `${baseSize * 3.5}px`;
  heroName.classList.toggle('placeholder-text', !c.portfolio_name);

  const heroTagline = document.getElementById('hero-tagline');
  heroTagline.textContent = c.portfolio_tagline || 'Your Professional Title';
  heroTagline.style.fontFamily = headingFontStack;
  heroTagline.style.fontSize = `${baseSize * 1.4}px`;
  heroTagline.classList.toggle('placeholder-text', !c.portfolio_tagline);

  const heroDesc = document.getElementById('hero-desc');
  heroDesc.textContent = c.hero_description || 'Add a brief introduction about yourself through the edit panel';
  heroDesc.style.fontFamily = baseFontStack;
  heroDesc.style.fontSize = `${baseSize}px`;
  heroDesc.classList.toggle('placeholder-text', !c.hero_description);

  // Avatar
  const avatar = document.getElementById('hero-avatar');
  avatar.textContent = (c.portfolio_name || 'Y')[0].toUpperCase();
  avatar.style.background = `linear-gradient(135deg, ${c.primary_color}, ${c.secondary_color})`;

  // Nav
  const navName = document.getElementById('nav-name');
  navName.textContent = c.portfolio_name ? c.portfolio_name.split(' ')[0] : 'Your Name';
  navName.style.fontFamily = headingFontStack;
  navName.classList.toggle('placeholder-text', !c.portfolio_name);

  // Contact email
  const contactEmail = document.getElementById('contact-email-display');
  contactEmail.textContent = c.contact_email || 'your.email@example.com';
  contactEmail.classList.toggle('placeholder-text', !c.contact_email);

  // Footer
  const footerEl = document.getElementById('footer-text-el');
  footerEl.textContent = c.footer_text || '© 2024 Your Name. All rights reserved.';
  footerEl.classList.toggle('placeholder-text', !c.footer_text);

  // Body font
  document.body.style.fontFamily = `${customFont}, ${baseFontStack}`;
  document.body.style.fontSize = `${baseSize}px`;
}

// Initialize Element SDK
window.elementSdk.init({
  defaultConfig,
  onConfigChange: async (config) => {
    applyConfig(config);
  },
  mapToCapabilities: (config) => ({
    recolorables: [
      {
        get: () => config.background_color || defaultConfig.background_color,
        set: (v) => { config.background_color = v; window.elementSdk.setConfig({ background_color: v }); }
      },
      {
        get: () => config.surface_color || defaultConfig.surface_color,
        set: (v) => { config.surface_color = v; window.elementSdk.setConfig({ surface_color: v }); }
      },
      {
        get: () => config.text_color || defaultConfig.text_color,
        set: (v) => { config.text_color = v; window.elementSdk.setConfig({ text_color: v }); }
      },
      {
        get: () => config.primary_color || defaultConfig.primary_color,
        set: (v) => { config.primary_color = v; window.elementSdk.setConfig({ primary_color: v }); }
      },
      {
        get: () => config.secondary_color || defaultConfig.secondary_color,
        set: (v) => { config.secondary_color = v; window.elementSdk.setConfig({ secondary_color: v }); }
      }
    ],
    borderables: [],
    fontEditable: {
      get: () => config.font_family || defaultConfig.font_family,
      set: (v) => { config.font_family = v; window.elementSdk.setConfig({ font_family: v }); }
    },
    fontSizeable: {
      get: () => config.font_size || defaultConfig.font_size,
      set: (v) => { config.font_size = v; window.elementSdk.setConfig({ font_size: v }); }
    }
  }),
  mapToEditPanelValues: (config) => new Map([
    ['portfolio_name', config.portfolio_name || ''],
    ['portfolio_tagline', config.portfolio_tagline || ''],
    ['hero_description', config.hero_description || ''],
    ['contact_email', config.contact_email || ''],
    ['footer_text', config.footer_text || '']
  ])
});

// Initialize Data SDK
(async () => {
  const result = await window.dataSdk.init(dataHandler);
  if (!result.isOk) {
    showToast('Failed to connect to data storage', 'error');
  }

  applyConfig(window.elementSdk.config || defaultConfig);
  document.getElementById('app').classList.add('edit-mode');
  
  // Show onboarding form on first load
  showOnboarding();
})();
</script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9cbd2ef9f7202e9c',t:'MTc3MDc0MzA0NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
