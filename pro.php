<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Portfolio Generator | G Dinesh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { iosBlue: '#007AFF', primary: '#3b82f6' },
                    backdropBlur: { 'ios': '20px' }
                }
            }
        }
    </script>
    <style>
        body { background: #0f172a; font-family: 'Inter', sans-serif; color: white; }
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .input-glass { background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s ease; }
        .input-glass:focus { border-color: #007AFF; background: rgba(255, 255, 255, 0.08); box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.15); }
        .portfolio-reveal { display: none; }
    </style>
</head>
<body class="min-h-screen p-4 md:p-10">

    <div id="formSection" class="max-w-4xl mx-auto glass rounded-[2.5rem] p-8 md:p-12 mb-20 shadow-2xl">
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-extrabold text-white mb-2 tracking-tight">Portfolio Generator</h1>
            <p class="text-slate-400">Fill in your details to generate your professional profile.</p>
        </header>

        <form id="masterForm" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Full Name</label>
                    <input type="text" id="inName" required placeholder="G Dinesh" class="w-full p-4 rounded-2xl text-white input-glass outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Date of Birth</label>
                    <input type="date" id="inDob" required class="w-full p-4 rounded-2xl text-white input-glass outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Email</label>
                    <input type="email" id="inEmail" required placeholder="dinesh@example.com" class="w-full p-4 rounded-2xl text-white input-glass outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Phone</label>
                    <input type="tel" id="inPhone" required placeholder="+91 ..." class="w-full p-4 rounded-2xl text-white input-glass outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-white/5">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Education</label>
                    <input type="text" id="inEdu" placeholder="B.Tech in CS" class="w-full p-4 rounded-2xl text-white input-glass outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Skills (Comma separated)</label>
                    <input type="text" id="inSkills" placeholder="Java, AI, Web Dev" class="w-full p-4 rounded-2xl text-white input-glass outline-none">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Address</label>
                    <input type="text" id="inAddress" placeholder="123 Street, City, Country" class="w-full p-4 rounded-2xl text-white input-glass outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Profile Photo</label>
                    <input type="file" id="inPhoto" accept="image/*" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-iosBlue file:text-white">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-300 ml-1">Resume (PDF)</label>
                    <input type="file" id="inResume" accept=".pdf" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-slate-700 file:text-white">
                </div>
            </div>

            <button type="submit" class="w-full py-5 rounded-3xl bg-iosBlue text-white font-bold text-lg hover:shadow-lg hover:shadow-blue-500/30 transition-all transform active:scale-95">
                Generate Portfolio
            </button>
        </form>
    </div>

    <div id="portfolioDisplay" class="portfolio-reveal max-w-5xl mx-auto space-y-10 pb-20">
        <div class="glass rounded-[3rem] p-10 flex flex-col md:flex-row items-center gap-10">
            <div class="relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-iosBlue to-cyan-400 rounded-full blur opacity-50"></div>
                <img id="outPhoto" src="" class="relative w-48 h-48 rounded-full object-cover border-4 border-white/10" alt="Profile">
            </div>
            <div class="text-center md:text-left space-y-4">
                <h2 id="outName" class="text-5xl font-extrabold tracking-tight"></h2>
                <p id="outEdu" class="text-2xl text-iosBlue font-medium"></p>
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                    <span class="flex items-center gap-2 bg-white/5 px-4 py-2 rounded-full text-sm border border-white/10">
                        <i data-lucide="mail" class="w-4 h-4"></i> <span id="outEmail"></span>
                    </span>
                    <span class="flex items-center gap-2 bg-white/5 px-4 py-2 rounded-full text-sm border border-white/10">
                        <i data-lucide="phone" class="w-4 h-4"></i> <span id="outPhone"></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 glass rounded-[2.5rem] p-8">
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                    <i data-lucide="user" class="text-iosBlue"></i> Personal Profile
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-slate-300">
                    <p><strong>DOB:</strong> <span id="outDob"></span></p>
                    <p><strong>Address:</strong> <span id="outAddress"></span></p>
                </div>
            </div>

            <div class="glass rounded-[2.5rem] p-8">
                <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                    <i data-lucide="zap" class="text-iosBlue"></i> Expertise
                </h3>
                <div id="outSkills" class="flex flex-wrap gap-2"></div>
            </div>
        </div>

        <div class="text-center pt-10">
            <a id="outResume" href="#" download class="inline-flex items-center gap-3 bg-white text-slate-900 px-10 py-4 rounded-full font-bold hover:bg-slate-200 transition-colors">
                <i data-lucide="download"></i> Download Full Resume
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();

        document.getElementById('masterForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Image Preview Handling
            const photoInput = document.getElementById('inPhoto');
            if (photoInput.files && photoInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('outPhoto').src = e.target.result;
                };
                reader.readAsDataURL(photoInput.files[0]);
            } else {
                document.getElementById('outPhoto').src = 'https://via.placeholder.com/200';
            }

            // Resume Handling (Mock download)
            const resumeInput = document.getElementById('inResume');
            if (resumeInput.files && resumeInput.files[0]) {
                document.getElementById('outResume').style.display = 'inline-flex';
            } else {
                document.getElementById('outResume').style.display = 'none';
            }

            // Mapping Text Data
            document.getElementById('outName').innerText = document.getElementById('inName').value;
            document.getElementById('outEdu').innerText = document.getElementById('inEdu').value;
            document.getElementById('outEmail').innerText = document.getElementById('inEmail').value;
            document.getElementById('outPhone').innerText = document.getElementById('inPhone').value;
            document.getElementById('outDob').innerText = document.getElementById('inDob').value;
            document.getElementById('outAddress').innerText = document.getElementById('inAddress').value;

            // Mapping Skills Tags
            const skillsArr = document.getElementById('inSkills').value.split(',');
            const skillsContainer = document.getElementById('outSkills');
            skillsContainer.innerHTML = '';
            skillsArr.forEach(skill => {
                if(skill.trim()) {
                    const span = document.createElement('span');
                    span.className = "bg-iosBlue/20 text-iosBlue border border-iosBlue/30 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider";
                    span.innerText = skill.trim();
                    skillsContainer.appendChild(span);
                }
            });

            // Reveal and Scroll
            const display = document.getElementById('portfolioDisplay');
            display.style.display = 'block';
            display.scrollIntoView({ behavior: 'smooth' });
            
            lucide.createIcons(); // Refresh icons for new content
        });
    </script>
</body>
</html>
