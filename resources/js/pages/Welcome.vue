<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Head } from '@inertiajs/vue3';

// Bahasa & Navigasi
const lang = ref('id');
const activeNav = ref(0);
const activeDropdown = ref(null);
const isMobileMenuOpen = ref(false);
const activeMobileDropdown = ref(null);

const toggleMobileDropdown = (idx) => {
  activeMobileDropdown.value = activeMobileDropdown.value === idx ? null : idx;
};

const texts = {
  id: {
    nav: [
      { name: 'Beranda', hasDropdown: false },
      { 
        name: 'Tentang Kami', 
        hasDropdown: true,
        dropdown: ['Profil Sekolah', 'Profil Guru']
      },
      { 
        name: 'Program', 
        hasDropdown: true,
        dropdown: ['Profil Jurusan', 'Ekstrakurikuler']
      },
      { name: 'Informasi', hasDropdown: false },
      { name: 'PPDB', hasDropdown: false }
    ],
    title1: 'Selamat',
    title2: 'Datang',
    school: 'SMK AIRLANGGA BALIKPAPAN',
    tagline1: 'SEKOLAH TANGGUH, BERAKHLAK',
    tagline2: '& BERWAWASAN DIGITAL',
    sambutan: {
      heading: 'Sambutan Kepala Sekolah',
      p1: 'Selamat datang di website resmi SMK Airlangga Balikpapan. Website ini merupakan jendela informasi sekaligus media komunikasi antara sekolah dengan siswa, orang tua, dan masyarakat luas.',
      p2: 'Kami berkomitmen mencetak lulusan yang tangguh, berakhlak mulia, dan siap menghadapi era digital. Melalui pendidikan kejuruan yang berkualitas, kami mengajak seluruh warga sekolah terus belajar, berkarya, dan mengabdi.',
      role: 'Kepala Sekolah',
      name: 'Saeful, S.Pd',
    },
    program: {
      heading: 'Program Keahlian',
      sub: 'Jurusan yang tersedia di Sekolah Airlangga Balikpapan',
      cta: 'Lihat detail jurusan',
    },
  },
  en: {
    nav: [
      { name: 'Home', hasDropdown: false },
      { 
        name: 'About Us', 
        hasDropdown: true,
        dropdown: ['School Profile', 'Teachers Profile']
      },
      { 
        name: 'Programs', 
        hasDropdown: true,
        dropdown: ['Vocational Majors', 'Extracurriculars']
      },
      { name: 'Information', hasDropdown: false },
      { name: 'Admissions', hasDropdown: false }
    ],
    title1: 'Welcome',
    title2: 'To',
    school: 'SMK AIRLANGGA BALIKPAPAN',
    tagline1: 'A RESILIENT, NOBLE-MINDED',
    tagline2: '& DIGITAL-ORIENTED SCHOOL',
    sambutan: {
      heading: 'Principal Welcome',
      p1: 'Welcome to the official website of SMK Airlangga Balikpapan. This website is a window of information and a communication bridge between the school, students, parents, and the wider community.',
      p2: 'We are committed to shaping graduates who are resilient, noble-minded, and ready for the digital era. Through quality vocational education, we invite the whole school community to keep learning, creating, and contributing.',
      role: 'Principal',
      name: 'Saeful, S.Pd',
    },
    program: {
      heading: 'Programs & Majors',
      sub: 'Majors available at SMK Airlangga Balikpapan',
      cta: 'View major details',
    },
  },
};

// Data jurusan - 2 layer terpisah per kartu (sesuai design):
//   bg     = foto background suasana/tempat  -> public/images/jurusan-xxx-bg.webp
//   person = foto orang (cutout transparan)  -> public/images/jurusan-xxx-orang.webp
const jurusan = [
  { name: 'Manajemen Perkantoran dan Layanan Bisnis', bg: '/images/jurusan-mplb-bg.webp', person: '/images/jurusan-mplb-orang.webp' },
  { name: 'Pengembangan Perangkat Lunak dan Gim', bg: '/images/jurusan-pplg-bg.webp', person: '/images/jurusan-pplg-orang.webp' },
  { name: 'Teknik Komputer Jaringan', bg: '/images/jurusan-tkj-bg.webp', person: '/images/jurusan-tkj-orang.webp' },
  { name: 'Akutansi Kelembagaan', bg: '/images/jurusan-akl-bg.webp', person: '/images/jurusan-akl-orang.webp' },
  { name: 'Design Komunikasi Visual', bg: '/images/jurusan-dkv-bg.webp', person: '/images/jurusan-dkv-orang.webp' },
];

// Sembunyikan img yang filenya belum ada (fallback ke gradient placeholder)
const hideBrokenImg = (e) => { e.target.style.display = 'none'; };

// Scroll-reveal (IntersectionObserver, tanpa scroll listener)
let observer = null;
onMounted(() => {
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.2 }
  );
  document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
});
onBeforeUnmount(() => observer?.disconnect());
</script>

<template>
  <Head>
    <title>SMK Airlangga Balikpapan</title>
  </Head>

  <main id="main-content" class="relative w-full select-none bg-slate-950 font-['Montserrat',sans-serif]">

  <section class="relative w-full min-h-[100dvh] h-[100dvh] overflow-hidden">
    
    <!-- Background (Responsive WebP Mobile/Desktop) -->
    <div class="absolute inset-0 z-0 anim-bg overflow-hidden pointer-events-none">
      <picture class="block w-full h-full">
        <source media="(max-width: 640px)" srcset="/images/hero-mobile.webp" type="image/webp">
        <img
          src="/images/hero.webp"
          alt="SMK Airlangga Balikpapan"
          loading="eager"
          fetchpriority="high"
          decoding="sync"
          width="1920"
          height="1080"
          class="w-full h-full object-cover object-center"
        />
      </picture>
      <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-black/25 to-black/40"></div>
    </div>

    <!-- Header -->
    <header class="absolute top-0 left-0 right-0 z-30 pt-3 sm:pt-6 px-4 sm:px-8 lg:px-12 anim-header">
      
      <!-- DESKTOP NAVBAR (≥ md) -->
      <div class="hidden md:flex items-start justify-between w-full">
        <!-- Spacer Kiri -->
        <div class="w-16 sm:w-24 shrink-0"></div>

        <!-- Navbar Tengah -->
        <div class="flex flex-col items-center mx-auto">
          <!-- Capsule Nav Container -->
          <div class="px-6 sm:px-8 py-2 rounded-full bg-black/75 backdrop-blur-md border border-white/20 shadow-2xl flex items-center space-x-5 sm:space-x-7 relative transition-all duration-300 ease-out">
            
            <!-- Menu Navigasi -->
            <nav class="flex items-center space-x-2.5 sm:space-x-4">
              <div
                v-for="(item, idx) in texts[lang].nav"
                :key="idx"
                class="relative"
                @mouseenter="item.hasDropdown ? activeDropdown = idx : null"
                @mouseleave="item.hasDropdown ? activeDropdown = null : null"
              >
                <button
                  type="button"
                  @click="activeNav = idx"
                  class="px-3.5 sm:px-4.5 py-1.5 rounded-full text-sm sm:text-base font-bold tracking-wide transition-all duration-200 cursor-pointer whitespace-nowrap flex items-center space-x-1.5"
                  :class="[
                    activeNav === idx 
                      ? 'bg-white text-slate-950 font-black shadow-md scale-105' 
                      : 'text-white/80 hover:text-white hover:bg-white/20 hover:scale-105'
                  ]"
                >
                  <span>{{ item.name }}</span>
                  <svg
                    v-if="item.hasDropdown"
                    class="w-3.5 h-3.5 ml-0.5 transition-transform duration-200"
                    :class="activeDropdown === idx ? 'rotate-180' : 'opacity-80'"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>

                <!-- Dropdown Menu Sejajar Presisi (Hover Bridge) -->
                <transition name="dropdown-anim">
                  <div
                    v-if="item.hasDropdown && activeDropdown === idx"
                    class="absolute top-full left-0 pt-2 min-w-full w-max z-50 pointer-events-auto"
                  >
                    <div class="py-1.5 bg-black/90 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl space-y-0.5">
                      <div
                        v-for="(sub, sIdx) in item.dropdown"
                        :key="sIdx"
                        class="px-4 sm:px-5 py-2 text-xs sm:text-sm font-bold text-white/90 hover:text-yellow-400 hover:bg-white/10 rounded-xl mx-1.5 cursor-pointer transition-colors duration-150 whitespace-nowrap text-left"
                      >
                        {{ sub }}
                      </div>
                    </div>
                  </div>
                </transition>
              </div>
            </nav>

            <!-- Switcher Bahasa (ID EN) -->
            <div class="pl-2 sm:pl-3">
              <div class="flex items-center bg-white/10 backdrop-blur-md rounded-full p-1 border border-white/20 shadow-inner">
                <button
                  type="button"
                  @click="lang = 'id'"
                  class="px-3.5 py-1 rounded-full text-xs sm:text-sm font-black transition-all duration-200 cursor-pointer"
                  :class="[
                    lang === 'id' 
                      ? 'bg-white text-black shadow-md font-extrabold scale-105' 
                      : 'text-white/80 hover:text-white font-bold'
                  ]"
                >
                  ID
                </button>
                <button
                  type="button"
                  @click="lang = 'en'"
                  class="px-3.5 py-1 rounded-full text-xs sm:text-sm font-black transition-all duration-200 cursor-pointer"
                  :class="[
                    lang === 'en' 
                      ? 'bg-white text-black shadow-md font-extrabold scale-105' 
                      : 'text-white/80 hover:text-white font-bold'
                  ]"
                >
                  EN
                </button>
              </div>
            </div>

          </div>

          <!-- Garis Bawah Navbar -->
          <div class="w-full sm:w-[96%] h-[2.5px] bg-black mt-2 rounded-full transition-all duration-300 ease-out"></div>
        </div>

        <!-- Logo Kanan Desktop -->
        <div class="w-16 sm:w-24 shrink-0 flex justify-end">
          <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 flex items-center justify-center filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.5)]">
            <img
              src="/images/logo-airlangga-sm.webp"
              alt="Logo SMK Airlangga Balikpapan"
              loading="eager"
              fetchpriority="high"
              decoding="async"
              width="96"
              height="96"
              class="w-full h-full object-contain"
            />
          </div>
        </div>
      </div>

      <!-- MOBILE NAVBAR (< md) -->
      <div class="flex md:hidden flex-col w-full">
        <div class="w-full flex items-center justify-between bg-black/80 backdrop-blur-xl border border-white/20 rounded-2xl px-4 py-2.5 shadow-2xl">
          <!-- Logo Kiri -->
          <div class="flex items-center gap-2">
            <img
              src="/images/logo-airlangga-sm.webp"
              alt="Logo SMK Airlangga Balikpapan"
              width="36"
              height="36"
              class="w-9 h-9 object-contain drop-shadow-md shrink-0"
            />
            <div class="flex flex-col leading-none">
              <span class="text-xs font-black tracking-wider text-white uppercase whitespace-nowrap">SMK AIRLANGGA</span>
              <span class="text-[9px] font-bold tracking-widest text-yellow-400 uppercase mt-0.5">BALIKPAPAN</span>
            </div>
          </div>

          <!-- Switcher Bahasa & Hamburger Button -->
          <div class="flex items-center gap-3">
            <div class="flex items-center bg-white/10 rounded-full p-0.5 border border-white/20">
              <button
                type="button"
                @click="lang = 'id'"
                class="px-2.5 py-0.5 rounded-full text-xs font-black transition-all"
                :class="lang === 'id' ? 'bg-white text-black shadow-sm' : 'text-white/80'"
              >
                ID
              </button>
              <button
                type="button"
                @click="lang = 'en'"
                class="px-2.5 py-0.5 rounded-full text-xs font-black transition-all"
                :class="lang === 'en' ? 'bg-white text-black shadow-sm' : 'text-white/80'"
              >
                EN
              </button>
            </div>

            <!-- Hamburger Button (44x44px Touch Target) -->
            <button
              type="button"
              @click="isMobileMenuOpen = !isMobileMenuOpen"
              class="w-11 h-11 flex items-center justify-center rounded-xl bg-white/10 text-white hover:bg-white/20 active:scale-95 transition-all"
              aria-label="Menu navigasi"
              :aria-expanded="isMobileMenuOpen"
            >
              <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <svg v-else class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <transition name="smooth-fade">
          <div
            v-if="isMobileMenuOpen"
            class="mt-2 w-full bg-black/90 backdrop-blur-2xl border border-white/20 rounded-2xl p-4 shadow-2xl space-y-1.5"
          >
            <div v-for="(item, idx) in texts[lang].nav" :key="idx" class="space-y-1">
              <div
                @click="item.hasDropdown ? toggleMobileDropdown(idx) : (activeNav = idx, isMobileMenuOpen = false)"
                class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-bold transition-all cursor-pointer"
                :class="activeNav === idx ? 'bg-white text-slate-950 font-black' : 'text-white/90 hover:bg-white/10'"
              >
                <span>{{ item.name }}</span>
                <svg
                  v-if="item.hasDropdown"
                  class="w-4 h-4 transition-transform duration-200"
                  :class="activeMobileDropdown === idx ? 'rotate-180' : 'opacity-70'"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
              </div>

              <!-- Submenu Drawer -->
              <div
                v-if="item.hasDropdown && activeMobileDropdown === idx"
                class="pl-4 pr-2 py-1 space-y-1 bg-white/5 rounded-xl"
              >
                <div
                  v-for="(sub, sIdx) in item.dropdown"
                  :key="sIdx"
                  @click="isMobileMenuOpen = false"
                  class="px-3 py-2 text-xs font-semibold text-white/80 hover:text-white hover:bg-white/10 rounded-lg cursor-pointer"
                >
                  {{ sub }}
                </div>
              </div>
            </div>
          </div>
        </transition>
      </div>

    </header>

    <!-- Teks Utama (Smooth Staggered Entrance) -->
    <div class="relative z-10 w-full h-full flex flex-col justify-center px-6 sm:px-12 md:px-16 lg:px-20 pt-20 sm:pt-0">
      <div class="max-w-3xl">
        
        <transition name="smooth-fade" mode="out-in">
          <div :key="lang" class="space-y-4 sm:space-y-6">
            
            <!-- Judul -->
            <div class="anim-title">
              <h1 class="text-5xl sm:text-7xl md:text-8xl lg:text-[100px] xl:text-[110px] font-black text-white leading-[0.92] tracking-tight drop-shadow-[0_4px_16px_rgba(0,0,0,0.85)]">
                <span class="block">{{ texts[lang].title1 }}</span>
                <span class="block">{{ texts[lang].title2 }}</span>
              </h1>
            </div>

            <!-- Subjudul -->
            <div class="pt-2 sm:pt-4 anim-school">
              <h2 class="text-base sm:text-xl md:text-2xl lg:text-[28px] font-black text-white tracking-wider uppercase drop-shadow-[0_2px_8px_rgba(0,0,0,0.85)]">
                {{ texts[lang].school }}
              </h2>
            </div>

            <!-- Slogan -->
            <div class="pt-2 sm:pt-6 space-y-1 anim-slogan">
              <p class="text-sm sm:text-lg md:text-xl lg:text-[22px] xl:text-[24px] font-black text-white tracking-wide uppercase leading-snug max-w-xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.85)]">
                {{ texts[lang].tagline1 }}
              </p>
              <p class="text-sm sm:text-lg md:text-xl lg:text-[22px] xl:text-[24px] font-black text-white tracking-wide uppercase leading-snug max-w-xl drop-shadow-[0_2px_8px_rgba(0,0,0,0.85)]">
                {{ texts[lang].tagline2 }}
              </p>
            </div>

          </div>
        </transition>

      </div>
    </div>

  </section>

  <!-- Sambutan Kepala Sekolah -->
  <section id="sambutan" class="relative w-full overflow-hidden text-white bg-[#1c3ba8] bg-gradient-to-br from-[#10257c] via-[#1c3ba8] to-[#2a55d4]">
    <!-- Dekorasi geometris (murni dekoratif, mengikuti mockup) -->
    <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
      <!-- Kedalaman gradient -->
      <div class="absolute inset-0 sambutan-glow"></div>
      <!-- Pita diagonal gelap kiri (signature mockup) -->
      <div class="absolute -top-24 -left-44 w-[55%] h-[150%] bg-[#0e2168]/60 -skew-x-12"></div>
      <!-- Panel diagonal kanan -->
      <div class="absolute top-0 right-0 w-[42%] h-full bg-[#2f5ad6]/50 [clip-path:polygon(38%_0,100%_0,100%_100%,0_100%)]"></div>
      <!-- Dua lingkaran lembut kanan-atas (sesuai mockup) -->
      <div class="absolute -top-16 right-[10%] w-56 h-56 sm:w-72 sm:h-72 rounded-full bg-white/[0.06]"></div>
      <div class="absolute top-32 right-[4%] w-20 h-20 sm:w-28 sm:h-28 rounded-full bg-white/10"></div>
      <!-- Glow halus di belakang foto -->
      <div class="absolute bottom-0 left-[4%] w-[36%] aspect-square rounded-full bg-[#4d79ff]/20 blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-20 lg:py-28 grid grid-cols-1 lg:grid-cols-12 gap-14 lg:gap-10 lg:items-end">

      <!-- Foto + Papan Nama -->
      <div class="lg:col-span-5 reveal">
        <div class="relative max-w-md mx-auto lg:mx-0 lg:-ml-24">
          <div class="relative aspect-[4/5]">
            <img
              src="/images/kepala-sekolah.webp"
              alt="Foto Kepala Sekolah SMK Airlangga Balikpapan"
              loading="lazy"
              decoding="async"
              width="502"
              height="653"
              class="rise absolute inset-x-0 bottom-0 h-full w-full object-contain object-bottom drop-shadow-[0_6px_14px_rgba(0,0,0,0.18)]"
            />
            <!-- Fade bawah: badan melebur ke background -->
            <div class="absolute inset-x-0 bottom-0 h-44 bg-gradient-to-t from-[#142e94] via-[#142e94]/60 to-transparent pointer-events-none"></div>
            <!-- Papan nama lebar menutupi badan foto (sesuai mockup) -->
            <div class="rise rise-2 absolute bottom-5 left-0 z-10 w-[88%] bg-white rounded-xl border-l-8 border-yellow-400 shadow-[0_4px_14px_rgba(0,0,0,0.12)] px-6 py-4">
              <p class="text-xl sm:text-2xl font-black text-slate-900 leading-tight">{{ texts[lang].sambutan.role }}</p>
              <p class="text-sm sm:text-base font-bold text-slate-600 mt-0.5">{{ texts[lang].sambutan.name }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Teks Sambutan -->
      <div class="lg:col-span-7 lg:pb-6 reveal reveal-delay">
        <transition name="smooth-fade" mode="out-in">
          <div :key="lang">
            <h2 class="rise text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
              {{ texts[lang].sambutan.heading }}
            </h2>
            <div class="bar-grow w-16 h-1.5 bg-yellow-400 rounded-full mt-4 mb-8"></div>
            <p class="rise rise-1 text-base sm:text-lg text-blue-100 leading-relaxed max-w-[65ch]">
              {{ texts[lang].sambutan.p1 }}
            </p>
            <p class="rise rise-2 text-base sm:text-lg text-blue-100 leading-relaxed max-w-[65ch] mt-5">
              {{ texts[lang].sambutan.p2 }}
            </p>
          </div>
        </transition>
      </div>

    </div>
  </section>

  <!-- Program Keahlian -->
  <section id="program" class="relative w-full overflow-hidden bg-[#0d1f4d] text-white">
    <!-- Dekorasi diagonal (murni dekoratif) -->
    <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
      <div class="absolute -top-32 -right-24 w-[45%] h-[130%] bg-[#12295f] -skew-x-12"></div>
      <div class="absolute top-0 -left-20 w-[30%] h-full bg-[#0a1838]/80 -skew-x-12"></div>
      <div class="absolute -bottom-24 right-[20%] w-72 h-72 rounded-full bg-white/[0.04]"></div>
    </div>

    <div class="relative z-10 max-w-[1700px] mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 reveal">
      <!-- Heading -->
      <h2 class="rise text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight">
        {{ texts[lang].program.heading }}
      </h2>
      <div class="bar-grow w-28 h-2 bg-yellow-400 rounded-full mt-4 mb-5"></div>
      <p class="rise rise-1 text-base sm:text-lg font-bold text-blue-100/90">
        {{ texts[lang].program.sub }}
      </p>

      <!-- Kartu Jurusan -->
      <div class="mt-12 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
        <div
          v-for="(j, i) in jurusan"
          :key="i"
          class="rise"
          :style="{ transitionDelay: (0.15 + i * 0.08) + 's' }"
        >
          <div class="group relative rounded-2xl overflow-hidden aspect-[9/16] bg-gradient-to-b from-[#1d3a7a] to-[#0a1838] ring-1 ring-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_16px_36px_rgba(0,0,0,0.6)] hover:ring-yellow-400/50 cursor-pointer">
            <!-- Layer 1: background suasana -->
            <img
              :src="j.bg"
              :alt="'Suasana ' + j.name"
              loading="lazy"
              decoding="async"
              @error="hideBrokenImg"
              class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
            />
            <!-- Layer 2: orang (cutout) di depan background -->
            <img
              :src="j.person"
              :alt="j.name"
              loading="lazy"
              decoding="async"
              @error="hideBrokenImg"
              class="absolute inset-x-0 bottom-0 h-full w-full object-contain object-bottom origin-bottom scale-[1.18] transition-transform duration-500 group-hover:scale-[1.24]"
            />
            <div class="absolute inset-0 bg-gradient-to-b from-black/55 via-black/10 to-black/60 transition-opacity duration-300 group-hover:opacity-80"></div>
            <!-- Judul jurusan -->
            <div class="absolute top-0 inset-x-0 p-4 sm:p-5 text-center">
              <h3 class="text-base sm:text-lg lg:text-xl font-black leading-snug drop-shadow-[0_2px_4px_rgba(0,0,0,0.6)] group-hover:text-yellow-400 transition-colors duration-200">
                {{ j.name }}
              </h3>
            </div>
            <!-- CTA -->
            <div class="absolute bottom-0 inset-x-0 p-4 sm:p-5 flex justify-center">
              <button
                type="button"
                class="bg-yellow-400 hover:bg-yellow-300 text-slate-950 text-sm sm:text-base font-black px-6 sm:px-7 py-2.5 rounded-full transition-all duration-200 shadow-md hover:shadow-[0_0_20px_rgba(250,204,21,0.6)] hover:scale-105 active:scale-95 cursor-pointer"
              >
                {{ texts[lang].program.cta }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  </main>
</template>

<style scoped>
/* Subtle Soft Text Shadow */
.shadow-subtle {
  text-shadow: 
    0 1px 3px rgba(0, 0, 0, 0.45),
    0 3px 8px rgba(0, 0, 0, 0.3);
}

/* Animasi Masuk Awal (Hardware-Accelerated CSS) */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(28px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-24px);
  }
  to {
    opacity: 1;
  }
}

@keyframes fadeInBg {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.anim-bg {
  animation: fadeInBg 0.9s ease-out both;
  will-change: opacity;
}

.anim-header {
  animation: fadeInDown 0.85s cubic-bezier(0.16, 1, 0.3, 1) both;
  will-change: transform, opacity;
}

.anim-title {
  animation: fadeInUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.15s both;
  will-change: transform, opacity;
}

.anim-school {
  animation: fadeInUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.3s both;
  will-change: transform, opacity;
}

.anim-slogan {
  animation: fadeInUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.45s both;
  will-change: transform, opacity;
}

/* Animasi Halus Pergantian Teks & Bahasa */
.smooth-fade-enter-active,
.smooth-fade-leave-active {
  transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  will-change: transform, opacity;
}

.smooth-fade-enter-from {
  opacity: 0;
  transform: translateY(6px);
}

.smooth-fade-leave-to {
  opacity: 0;
  transform: translateY(-6px);
}

/* Dekorasi section sambutan */
.sambutan-glow {
  background:
    radial-gradient(ellipse 60% 50% at 85% 10%, rgba(122, 162, 255, 0.28), transparent 60%),
    radial-gradient(ellipse 50% 45% at 10% 90%, rgba(8, 16, 60, 0.55), transparent 65%),
    radial-gradient(ellipse 40% 35% at 45% 45%, rgba(255, 255, 255, 0.06), transparent 70%);
}

/* Scroll-reveal section sambutan (stagger per elemen) */
.reveal .rise {
  opacity: 0;
  transform: translateY(22px);
  transition:
    opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1),
    transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
  will-change: transform, opacity;
}

.reveal.is-visible .rise {
  opacity: 1;
  transform: translateY(0);
}

.rise-1 { transition-delay: 0.12s; }
.rise-2 { transition-delay: 0.24s; }

.bar-grow {
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s;
}

.reveal.is-visible .bar-grow {
  transform: scaleX(1);
}

@media (prefers-reduced-motion: reduce) {
  .reveal .rise,
  .bar-grow {
    opacity: 1;
    transform: none;
    transition: none;
  }
}

/* Animasi Dropdown Menu */
.dropdown-anim-enter-active,
.dropdown-anim-leave-active {
  transition: opacity 0.2s cubic-bezier(0.16, 1, 0.3, 1), transform 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.dropdown-anim-enter-from,
.dropdown-anim-leave-to {
  opacity: 0;
  transform: translateY(-6px);
}
</style>
