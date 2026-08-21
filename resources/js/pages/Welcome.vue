<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

// Bahasa
const lang = ref('id');
const activeNav = ref(0);
const activeDropdown = ref(null);

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
  },
};
</script>

<template>
  <Head>
    <title>SMK Airlangga Balikpapan</title>
    <!-- Preconnect & Preload LCP Asset -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="preload" as="image" href="/images/hero.webp" type="image/webp" fetchpriority="high">
    <link rel="preload" as="image" href="/images/logo-airlangga.webp" type="image/webp" fetchpriority="high">
    <meta name="description" content="Website Resmi SMK Airlangga Balikpapan - Sekolah Tangguh, Berakhlak, dan Berwawasan Digital.">
  </Head>

  <div class="relative w-full h-screen min-h-[600px] overflow-hidden select-none bg-slate-950 font-['Montserrat',sans-serif]">
    
    <!-- Background (Murni WebP Full HD) -->
    <div class="absolute inset-0 z-0 anim-bg">
      <img
        src="/images/hero.webp"
        alt="SMK Airlangga Balikpapan"
        fetchpriority="high"
        decoding="async"
        class="w-full h-full object-cover object-center"
      />
      <div class="absolute inset-0 bg-black/10 pointer-events-none"></div>
    </div>

    <!-- Header -->
    <header class="absolute top-0 left-0 right-0 z-30 pt-4 sm:pt-6 px-6 sm:px-12 flex items-start justify-between anim-header">
      
      <!-- Spacer Kiri -->
      <div class="w-16 sm:w-24 hidden md:block"></div>

      <!-- Navbar -->
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
                <!-- Ikon Panah Dropdown -->
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

              <!-- Dropdown Menu Sejajar Presisi -->
              <transition name="dropdown-anim">
                <div
                  v-if="item.hasDropdown && activeDropdown === idx"
                  class="absolute top-full left-0 mt-2.5 min-w-full w-max py-1.5 bg-black/85 backdrop-blur-md border border-white/20 rounded-2xl shadow-2xl z-50 space-y-0.5"
                >
                  <div
                    v-for="(sub, sIdx) in item.dropdown"
                    :key="sIdx"
                    class="px-4 sm:px-5 py-2 text-xs sm:text-sm font-bold text-white/90 hover:text-white hover:bg-white/20 rounded-xl mx-1.5 cursor-pointer transition whitespace-nowrap text-left"
                  >
                    {{ sub }}
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

      <!-- Logo Transparan (Murni WebP) -->
      <div class="w-16 sm:w-24 shrink-0 flex justify-end">
        <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 flex items-center justify-center filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.5)]">
          <img
            src="/images/logo-airlangga.webp"
            alt="Logo SMK Airlangga Balikpapan"
            loading="eager"
            fetchpriority="high"
            decoding="async"
            class="w-full h-full object-contain"
          />
        </div>
      </div>

    </header>

    <!-- Teks Utama (Smooth Staggered Entrance) -->
    <div class="relative z-10 w-full h-full flex flex-col justify-center px-6 sm:px-12 md:px-16 lg:px-20">
      <div class="max-w-3xl">
        
        <transition name="smooth-fade" mode="out-in">
          <div :key="lang" class="space-y-4 sm:space-y-6">
            
            <!-- Judul -->
            <div class="anim-title">
              <h1 class="text-6xl sm:text-7xl md:text-8xl lg:text-[100px] xl:text-[110px] font-black text-white leading-[0.9] tracking-tight shadow-subtle">
                <span class="block">{{ texts[lang].title1 }}</span>
                <span class="block">{{ texts[lang].title2 }}</span>
              </h1>
            </div>

            <!-- Subjudul -->
            <div class="pt-2 sm:pt-4 anim-school">
              <h2 class="text-base sm:text-xl md:text-2xl lg:text-[28px] font-black text-white tracking-wider uppercase shadow-subtle">
                {{ texts[lang].school }}
              </h2>
            </div>

            <!-- Slogan -->
            <div class="pt-4 sm:pt-6 space-y-1 anim-slogan">
              <p class="text-sm sm:text-lg md:text-xl lg:text-[22px] xl:text-[24px] font-black text-white tracking-wide uppercase leading-snug max-w-xl shadow-subtle">
                {{ texts[lang].tagline1 }}
              </p>
              <p class="text-sm sm:text-lg md:text-xl lg:text-[22px] xl:text-[24px] font-black text-white tracking-wide uppercase leading-snug max-w-xl shadow-subtle">
                {{ texts[lang].tagline2 }}
              </p>
            </div>

          </div>
        </transition>

      </div>
    </div>

  </div>
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
