// ==========================================
// FORM VALIDATION - Upload Page
// ==========================================
const uploadForm = document.getElementById('uploadForm');
if (uploadForm) {
    uploadForm.addEventListener('submit', function (e) {
        const name    = document.getElementById('name').value.trim();
        const email   = document.getElementById('email').value.trim();
        const jobrole = document.getElementById('jobrole').value.trim();
        const resume  = document.getElementById('resume').files[0];

        if (!name) {
            e.preventDefault();
            alert('Please enter your name.');
            return;
        }
        if (!email || !email.includes('@')) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            return;
        }
        if (!jobrole) {
            e.preventDefault();
            alert('Please enter the job role you are applying for.');
            return;
        }
        if (!resume) {
            e.preventDefault();
            alert('Please select a resume file to upload.');
            return;
        }

        const allowed = ['pdf', 'doc', 'docx'];
        const ext     = resume.name.split('.').pop().toLowerCase();
        if (!allowed.includes(ext)) {
            e.preventDefault();
            alert('Only PDF, DOC, DOCX files are allowed.');
            return;
        }

        if (resume.size > 2 * 1024 * 1024) {
            e.preventDefault();
            alert('File size must be under 2MB.');
            return;
        }
    });
}

// ==========================================
// DRAG AND DROP - Upload Page
// ==========================================
const dropArea  = document.getElementById('dropArea');
const fileInput = document.getElementById('resume');
const fileName  = document.getElementById('fileName');

if (dropArea && fileInput) {
    dropArea.addEventListener('click', () => fileInput.click());

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.style.borderColor = '#ff4d4d';
        dropArea.style.background  = '#1a0000';
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.borderColor = '#3a3a3a';
        dropArea.style.background  = 'transparent';
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.style.borderColor    = '#3a3a3a';
        dropArea.style.background     = 'transparent';
        fileInput.files               = e.dataTransfer.files;
        fileName.textContent          = e.dataTransfer.files[0].name;
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files[0]) {
            fileName.textContent = fileInput.files[0].name;
        }
    });
}

// ==========================================
// CONTACT FORM VALIDATION - About Page
// ==========================================
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
        const name    = document.getElementById('contactName').value.trim();
        const email   = document.getElementById('contactEmail').value.trim();
        const message = document.getElementById('contactMessage').value.trim();

        if (!name) {
            e.preventDefault();
            alert('Please enter your name.');
            return;
        }
        if (!email || !email.includes('@')) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            return;
        }
        if (!message) {
            e.preventDefault();
            alert('Please enter a message.');
            return;
        }
    });
}

// ==========================================
// ROAST ENGINE - Results Page
// ==========================================
if (typeof resumeData !== 'undefined') {

    const roasts = [
        "Your job role is '{jobrole}'? Bold choice for someone with a resume like this. 🔥",
        "We've seen better formatting on a grocery list.",
        "Your resume screams 'I copy-pasted this from a template and didn't even change the font.'",
        "The good news: it's only 1 page. The bad news: it shouldn't be.",
        "We couldn't find any quantifiable achievements. Did you actually do anything?",
        "Your skills section lists Microsoft Word. In 2024. Seriously.",
        "Your objective statement is so generic it could apply to literally anyone.",
        "We detected zero action verbs. You didn't 'lead', 'build', or 'achieve' anything apparently.",
    ];

    const tips = [
        "Use strong action verbs: Led, Built, Designed, Improved, Achieved.",
        "Quantify your achievements: 'Increased sales by 30%' beats 'Helped with sales'.",
        "Remove the Objective section — replace it with a Professional Summary.",
        "List only relevant skills. Remove MS Word, MS Paint, and basic tools.",
        "Keep formatting consistent — same font, same bullet style throughout.",
        "Add LinkedIn and GitHub links if applying for tech roles.",
        "Tailor your resume for each job — one size does NOT fit all.",
        "Proofread. Then proofread again. Then ask someone else to proofread.",
    ];

    // Animate scores
    function animateScore(id, target, delay) {
        setTimeout(() => {
            let current = 0;
            const interval = setInterval(() => {
                current++;
                document.getElementById(id).textContent = current + '/10';
                if (current >= target) clearInterval(interval);
            }, 60);
        }, delay);
    }

    const formatScore  = Math.floor(Math.random() * 4) + 3;
    const contentScore = Math.floor(Math.random() * 4) + 3;
    const skillsScore  = Math.floor(Math.random() * 4) + 3;
    const overallScore = Math.floor((formatScore + contentScore + skillsScore) / 3);

    animateScore('scoreFormat',  formatScore,  200);
    animateScore('scoreContent', contentScore, 400);
    animateScore('scoreSkills',  skillsScore,  600);
    animateScore('scoreOverall', overallScore, 800);

    // Show roast messages
    const roastBox = document.getElementById('roastMessages');
    roasts.forEach((msg, i) => {
        setTimeout(() => {
            const div = document.createElement('div');
            div.style.cssText = 'color:#ffaaaa; font-size:14px; line-height:1.6; padding:8px 0; border-bottom:1px solid #2a0000;';
            div.textContent   = msg.replace('{jobrole}', resumeData.jobrole);
            roastBox.appendChild(div);
        }, i * 300);
    });

    // Show tips
    const tipsBox = document.getElementById('tipMessages');
    tips.forEach((tip, i) => {
        setTimeout(() => {
            const div = document.createElement('div');
            div.style.cssText = 'color:#aaffaa; font-size:14px; line-height:1.6; padding:8px 0; border-bottom:1px solid #002a00;';
            div.textContent   = '✓ ' + tip;
            tipsBox.appendChild(div);
        }, i * 300);
    });
}