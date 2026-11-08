@extends('dashboard.mascool.layouts.app')
@section('title', 'محرر الصفحة الرئيسية')

@push('styles')
<style>
    /* ---------- visual home page editor ---------- */
    .editor{display:grid;grid-template-columns:45fr 55fr;gap:16px;align-items:start}
    .editor__panel{min-width:0}
    .editor__preview{min-width:0;position:sticky;top:calc(var(--header-h) + 14px)}

    .eyebrow-tag{display:inline-flex;align-items:center;gap:7px;padding:4px 11px;border-radius:var(--r-pill);
        background:var(--navy);color:var(--lime);font-size:11px;font-weight:800;letter-spacing:.05em}

    /* section selector */
    .sec-nav{display:flex;gap:7px;overflow-x:auto;padding:4px 2px 10px;scrollbar-width:none;margin-bottom:14px}
    .sec-nav::-webkit-scrollbar{display:none}
    .sec-chip{flex:0 0 auto;display:inline-flex;align-items:center;gap:7px;min-height:40px;padding:7px 14px;
        border:1px solid var(--line);border-radius:var(--r-sm);background:#fff;font-size:13.5px;font-weight:700;color:var(--muted);white-space:nowrap}
    .sec-chip:hover{border-color:#b9ccd4;color:var(--navy)}
    .sec-chip.is-active{background:var(--navy);border-color:var(--navy);color:#fff}
    .sec-chip .dot{width:7px;height:7px;border-radius:50%;background:var(--lime);flex:none}
    .sec-chip .dot--off{background:#c3d0d5}
    .sec-select{display:none}

    /* preview frame */
    .preview-bar{display:flex;align-items:center;gap:8px;flex-wrap:wrap;padding:10px 12px;border:1px solid var(--line-soft);
        border-bottom:0;border-radius:var(--r-lg) var(--r-lg) 0 0;background:#fff}
    .preview-bar__title{font-size:13px;font-weight:800;margin-inline-end:auto}
    .seg{display:inline-flex;border:1px solid var(--line);border-radius:var(--r-sm);overflow:hidden}
    .seg button{min-height:34px;padding:4px 13px;border:0;background:#fff;font-size:12.5px;font-weight:700;color:var(--muted);cursor:pointer}
    .seg button.is-active{background:var(--navy);color:#fff}
    .preview-shell{border:1px solid var(--line-soft);border-radius:0 0 var(--r-lg) var(--r-lg);background:var(--ice);
        padding:12px;display:flex;justify-content:center;overflow:hidden}
    .preview-frame{width:100%;max-width:100%;height:70vh;min-height:460px;border:1px solid var(--line);border-radius:var(--r-md);
        background:#fff;transition:max-width .25s ease}
    .preview-shell[data-mode="mobile"] .preview-frame{max-width:390px}

    /* repeaters */
    .rep{border:1px solid var(--line-soft);border-radius:var(--r-md);background:#fff;margin-bottom:10px}
    .rep__head{display:flex;align-items:center;gap:10px;padding:10px 12px;border-bottom:1px solid var(--line-soft);flex-wrap:wrap}
    .rep__index{width:26px;height:26px;border-radius:50%;background:var(--ice);display:grid;place-items:center;font-size:11px;font-weight:800;flex:none}
    .rep__title{font-size:13.5px;font-weight:700;flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .rep__tools{display:flex;gap:5px;align-items:center;flex-wrap:wrap}
    .rep__body{padding:12px}
    .icon-btn{width:32px;height:32px;display:grid;place-items:center;border:1px solid var(--line);border-radius:var(--r-sm);
        background:#fff;font-size:13px;color:var(--muted);cursor:pointer}
    .icon-btn:hover:not([disabled]){border-color:var(--navy);color:var(--navy)}
    .icon-btn[disabled]{opacity:.35;cursor:not-allowed}
    .rep-add{border:1px dashed #b9ccd4;border-radius:var(--r-md);background:var(--paper);padding:14px}
    .limit-note{font-size:12px;color:var(--muted);margin-bottom:10px}
    .limit-note.is-over{color:#b3261e;font-weight:700}

    .save-row{display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-top:14px;
        position:sticky;bottom:0;background:linear-gradient(180deg,rgba(248,251,251,0),var(--paper) 40%);padding:12px 0 2px}
    .dirty-flag{display:none;align-items:center;gap:6px;font-size:12.5px;font-weight:700;color:#916c05}
    .dirty-flag.is-on{display:inline-flex}
    .dirty-flag:before{content:"";width:7px;height:7px;border-radius:50%;background:#e0a800}

    @media(max-width:1180px){
        .editor{grid-template-columns:1fr}
        .editor__preview{position:static;order:-1}
        .preview-frame{height:52vh;min-height:360px}
    }
    @media(max-width:640px){
        .sec-nav{display:none}
        .sec-select{display:block;margin-bottom:14px}
        .preview-shell[data-mode="desktop"] .preview-frame{max-width:100%}
        .rep__tools{width:100%;justify-content:flex-end}
    }
</style>
@endpush

@section('content')
@php
    /** @var \Illuminate\Support\Collection $sections */
    $active = $sectionMap->get($activeKey);
@endphp

<div class="page-head">
    <div class="page-head__text">
        <span class="eyebrow-tag">محرر الصفحة الرئيسية المرئي</span>
        <h1 style="margin-top:8px">تعديل الصفحة الرئيسية قسمًا بقسم</h1>
        <p>كل الأقسام والعناصر المتكررة تُدار من هنا. المعدات والتصنيفات لها صفحات مستقلة.</p>
    </div>
    <a class="btn btn--dark" href="{{ route('landing') }}" target="_blank" rel="noopener">
        <svg class="ic" width="16" height="16" aria-hidden="true"><use href="#i-eye"/></svg> فتح الصفحة الحية
    </a>
</div>

{{-- ---------- section selector ---------- --}}
<nav class="sec-nav" aria-label="أقسام الصفحة الرئيسية">
    @foreach($sections as $section)
        <a class="sec-chip {{ $section->key === $activeKey ? 'is-active' : '' }}"
           href="{{ route('admin.home.editor', ['section' => $section->key]) }}"
           @if($section->key === $activeKey) aria-current="true" @endif>
            <span class="dot {{ $section->is_active ? '' : 'dot--off' }}" aria-hidden="true"></span>
            {{ $section->label() }}
        </a>
    @endforeach
    <a class="sec-chip {{ $activeKey === 'seo' ? 'is-active' : '' }}" href="{{ route('admin.home.editor', ['section' => 'seo']) }}">
        <span class="dot" aria-hidden="true"></span> SEO
    </a>
</nav>

<div class="sec-select field">
    <label for="sectionJump">اختر القسم</label>
    <select id="sectionJump" onchange="location.href=this.value">
        @foreach($sections as $section)
            <option value="{{ route('admin.home.editor', ['section' => $section->key]) }}" @selected($section->key === $activeKey)>
                {{ $section->label() }}{{ $section->is_active ? '' : ' (مخفي)' }}
            </option>
        @endforeach
        <option value="{{ route('admin.home.editor', ['section' => 'seo']) }}" @selected($activeKey === 'seo')>SEO</option>
    </select>
</div>

<div class="editor">
    {{-- ---------- editor panel ---------- --}}
    <div class="editor__panel">
        @if($activeKey === 'seo')
            @include('dashboard.home.sections._seo')
        @else
            @include('dashboard.home.sections._section', ['section' => $active])
        @endif
    </div>

    {{-- ---------- live preview ---------- --}}
    <div class="editor__preview">
        <div class="preview-bar">
            <span class="preview-bar__title">معاينة حية</span>
            <div class="seg" role="group" aria-label="عرض المعاينة">
                <button type="button" class="is-active" data-preview-mode="desktop">سطح المكتب</button>
                <button type="button" data-preview-mode="mobile">موبايل</button>
            </div>
            <button type="button" class="btn btn--outline btn--sm" id="previewRefresh">تحديث</button>
        </div>
        <div class="preview-shell" data-mode="desktop" id="previewShell">
            <iframe class="preview-frame" id="previewFrame" src="{{ $previewUrl }}"
                    title="معاينة الصفحة الرئيسية" loading="lazy"></iframe>
        </div>
        <p class="hint" style="margin-top:8px">روابط واتساب معطّلة داخل المعاينة. اضغط أي قسم في المعاينة للانتقال لتبويبه.</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
'use strict';
(function(){
    const frame=document.getElementById('previewFrame');
    const shell=document.getElementById('previewShell');
    const refresh=document.getElementById('previewRefresh');
    const activeKey=@json($activeKey);
    const baseUrl=@json($previewUrl);
    const editorBase=@json(route('admin.home.editor'));
    const origin=new URL(baseUrl, location.href).origin;

    // desktop / mobile preview widths
    document.querySelectorAll('[data-preview-mode]').forEach(btn=>{
        btn.addEventListener('click',()=>{
            document.querySelectorAll('[data-preview-mode]').forEach(b=>b.classList.toggle('is-active',b===btn));
            shell.dataset.mode=btn.dataset.previewMode;
        });
    });
    refresh.addEventListener('click',()=>{frame.contentWindow.location.reload();});

    /* on a phone the preview opens at mobile width — a desktop frame is unreadable there */
    if(matchMedia('(max-width:640px)').matches){
        document.querySelector('[data-preview-mode="mobile"]').click();
    }

    function tellPreview(){
        try{ frame.contentWindow.postMessage({source:'mascool-editor',action:'highlight',section:activeKey},origin); }catch(_){}
    }
    frame.addEventListener('load',tellPreview);

    addEventListener('message',e=>{
        if(e.origin!==origin)return;                       // validate origin
        const d=e.data;
        if(!d||d.source!=='mascool-preview')return;
        if(d.action==='ready')tellPreview();
        if(d.action==='select'&&d.section){
            location.href=editorBase+'?section='+encodeURIComponent(d.section);
        }
    });

    // unsaved-changes indicator + guard
    const form=document.querySelector('form[data-track-dirty]');
    const flag=document.getElementById('dirtyFlag');
    if(form){
        let dirty=false;
        form.addEventListener('input',()=>{dirty=true;if(flag)flag.classList.add('is-on');});
        form.addEventListener('submit',()=>{dirty=false;});
        addEventListener('beforeunload',e=>{if(dirty){e.preventDefault();e.returnValue='';}});
    }
})();
</script>
@endpush
