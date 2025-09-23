<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean
});
</script>

<template>
  <Head title="منصة الفعاليات" />

  <div class="bg-gray-50 dark:bg-zinc-900 text-black/90 dark:text-white/90 min-h-screen flex flex-col">

    <!-- الهيدر -->
    <header class="bg-white dark:bg-zinc-950 shadow-md fixed w-full z-50">
      <div class="max-w-7xl mx-auto flex justify-between items-center p-6">
        <h1 class="text-2xl font-bold text-[#FF2D20]">منصة الفعاليات</h1>
        <nav class="flex gap-4">
          <Link
            v-if="canLogin"
            :href="route('login')"
            class="px-4 py-2 rounded-md bg-[#FF2D20] text-white hover:bg-[#e0261d] transition"
          >
            تسجيل الدخول
          </Link>
          <Link
            v-if="canRegister"
            :href="route('register')"
            class="px-4 py-2 rounded-md border border-[#FF2D20] text-[#FF2D20] hover:bg-[#FF2D20] hover:text-white transition"
          >
            إنشاء حساب
          </Link>
        </nav>
      </div>
    </header>

    <!-- القسم الترحيبي Hero -->
    <section class="relative flex-1 flex flex-col items-center justify-center text-center px-6 pt-32 pb-20 bg-gradient-to-b from-[#FF2D20]/40 via-transparent to-gray-50 dark:to-zinc-950">
      <h2 class="text-5xl md:text-6xl font-extrabold text-[#FF2D20] mb-6 drop-shadow-lg">
        مرحباً بك في منصة الفعاليات
      </h2>
      <p class="max-w-3xl text-lg md:text-xl mb-10 text-black/80 dark:text-white/80">
        استكشف فعالياتنا المتنوعة، انضم إلى الأحداث المميزة، وكن جزءًا من مجتمع نشط وحيوي.  
        كل ما تحتاجه لتجربة استثنائية ستجده هنا.
      </p>
      <div class="flex flex-wrap justify-center gap-4">
        <Link
          v-if="canLogin"
          :href="route('login')"
          class="px-8 py-3 bg-[#FF2D20] text-white rounded-md hover:bg-[#e0261d] transition"
        >
          تسجيل الدخول
        </Link>
        <Link
          v-if="canRegister"
          :href="route('register')"
          class="px-8 py-3 border border-[#FF2D20] text-[#FF2D20] rounded-md hover:bg-[#FF2D20] hover:text-white transition"
        >
          إنشاء حساب
        </Link>
      </div>
      <!-- زخرفة خلفية -->
      <div class="absolute inset-0 -z-10">
        <div class="w-full h-full bg-[url('https://images.unsplash.com/photo-1531058020387-3be344556be6?auto=format&fit=crop&w=1470&q=80')] bg-cover bg-center opacity-30 dark:opacity-20"></div>
      </div>
    </section>

    <!-- قسم عن المنصة -->
    <section class="max-w-7xl mx-auto py-20 px-6 text-center">
      <h3 class="text-4xl font-bold text-[#FF2D20] mb-10">عن منصتنا</h3>
      <p class="max-w-3xl mx-auto text-lg md:text-xl text-black/80 dark:text-white/80">
        منصة الفعاليات صممت لتوفر لك تجربة متكاملة لمتابعة أحدث الفعاليات، التسجيل فيها، والتفاعل مع مجتمع نشط من المشاركين. 
        نقدم محتوى متنوع وأحداث مميزة تلبي كل اهتماماتك.
      </p>
    </section>

    <!-- قسم أحدث الفعاليات -->
    <section class="bg-gray-100 dark:bg-zinc-950 py-20 px-6">
      <h3 class="text-4xl font-bold text-center text-[#FF2D20] mb-12">أحدث الفعاليات</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-7xl mx-auto">
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-lg hover:scale-105 transition">
          <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=600&q=80" class="rounded-lg mb-4" />
          <h4 class="text-2xl font-semibold mb-2">فعالية رياضية</h4>
          <p class="text-gray-600 dark:text-gray-300">انضم إلينا في منافسات رياضية مثيرة لجميع الأعمار.</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-lg hover:scale-105 transition">
          <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=600&q=80" class="rounded-lg mb-4" />
          <h4 class="text-2xl font-semibold mb-2">ورشة عمل تعليمية</h4>
          <p class="text-gray-600 dark:text-gray-300">تعلّم مهارات جديدة من خبراء في مجالات متعددة.</p>
        </div>
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-lg hover:scale-105 transition">
          <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=600&q=80" class="rounded-lg mb-4" />
          <h4 class="text-2xl font-semibold mb-2">حفلة موسيقية</h4>
          <p class="text-gray-600 dark:text-gray-300">استمتع بأمسية موسيقية رائعة مع أفضل الفرق الموسيقية.</p>
        </div>
      </div>
    </section>

    <!-- قسم مميزاتنا -->
    <section class="max-w-7xl mx-auto py-20 px-6 text-center">
      <h3 class="text-4xl font-bold text-[#FF2D20] mb-10">مميزاتنا</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="p-6 bg-white dark:bg-zinc-900 rounded-xl shadow-lg hover:shadow-2xl transition">
          <h4 class="text-2xl font-semibold mb-2">تجربة سهلة</h4>
          <p class="text-gray-600 dark:text-gray-300">واجهة مستخدم سلسة وسهلة الاستخدام لجميع الأعمار.</p>
        </div>
        <div class="p-6 bg-white dark:bg-zinc-900 rounded-xl shadow-lg hover:shadow-2xl transition">
          <h4 class="text-2xl font-semibold mb-2">تنوع الفعاليات</h4>
          <p class="text-gray-600 dark:text-gray-300">فعاليات متنوعة تناسب كل الاهتمامات والهوايات.</p>
        </div>
        <div class="p-6 bg-white dark:bg-zinc-900 rounded-xl shadow-lg hover:shadow-2xl transition">
          <h4 class="text-2xl font-semibold mb-2">تواصل اجتماعي</h4>
          <p class="text-gray-600 dark:text-gray-300">فرصة للتواصل والتفاعل مع المشاركين الآخرين.</p>
        </div>
      </div>
    </section>

    <!-- قسم آراء المشاركين -->
    <section class="bg-gray-100 dark:bg-zinc-950 py-20 px-6">
      <h3 class="text-4xl font-bold text-center text-[#FF2D20] mb-12">آراء المشاركين</h3>
      <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-lg">
          <p class="text-gray-600 dark:text-gray-300 mb-4">"أفضل تجربة فعلاً! التنظيم والفعاليات كانت رائعة."</p>
          <h5 class="font-semibold">سارة أ.</h5>
        </div>
        <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl shadow-lg">
          <p class="text-gray-600 dark:text-gray-300 mb-4">"أنصح الجميع بالانضمام، تجربة مليئة بالنشاط والحماس."</p>
          <h5 class="font-semibold">محمد ر.</h5>
        </div>
      </div>
    </section>

    <!-- الفوتر -->
    <footer class="bg-white dark:bg-zinc-950 shadow-inner py-10 text-center text-sm text-black/60 dark:text-white/60">
      <p>&copy; 2025 منصة الفعاليات. جميع الحقوق محفوظة.</p>
      <div class="flex justify-center gap-6 mt-4">
        <a href="#" class="hover:text-[#FF2D20] transition">فيسبوك</a>
        <a href="#" class="hover:text-[#FF2D20] transition">تويتر</a>
        <a href="#" class="hover:text-[#FF2D20] transition">إنستغرام</a>
      </div>
    </footer>

  </div>
</template>
