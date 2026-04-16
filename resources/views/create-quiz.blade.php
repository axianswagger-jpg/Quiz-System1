@extends('layouts.app')

@section('content')

<style>
  .cq-wrap { max-width: 720px; margin: 0 auto; padding: 32px 16px 60px; }

  .cq-header {
    background: linear-gradient(135deg, #1a3a6b, #0d2a52);
    border-radius: 16px 16px 0 0;
    border-top: 8px solid #68c3ff;
    padding: 28px 32px;
    margin-bottom: 0;
  }
  .cq-header h1 { font-size: 32px; font-weight: 700; margin: 0 0 6px; color: #fff; }
  .cq-header p  { color: #aac4e0; font-size: 15px; margin: 0; }

  .cq-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 24px 28px;
    margin-bottom: 16px;
    border-left: 5px solid #68c3ff;
  }

  .cq-card h2 { font-size: 17px; font-weight: 700; margin: 0 0 16px; color: #eaf1fc; }

  .cq-label {
    display: block;
    font-size: 13px;
    color: #9fb0cb;
    margin-bottom: 6px;
    margin-top: 14px;
  }

  .cq-input {
    width: 100%;
    padding: 11px 14px;
    background: rgba(255,255,255,0.06);
    border: none;
    border-bottom: 2px solid rgba(255,255,255,0.15);
    border-radius: 6px 6px 0 0;
    color: #eaf1fc;
    font-size: 15px;
    outline: none;
    font-family: inherit;
    transition: border-color 0.2s;
  }
  .cq-input:focus { border-bottom-color: #68c3ff; }
  textarea.cq-input {
    resize: vertical;
    min-height: 80px;
    border-radius: 6px 6px 0 0;
  }

  .cq-question-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 12px;
    padding: 20px 24px;
    margin-bottom: 14px;
    border-left: 4px solid rgba(104,195,255,0.4);
    transition: border-left-color 0.2s;
  }
  .cq-question-card:focus-within { border-left-color: #68c3ff; }

  .cq-question-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
  }
  .cq-question-header span {
    font-size: 13px;
    font-weight: 600;
    color: #68c3ff;
    letter-spacing: 0.04em;
  }

  .cq-option-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
  }
  .cq-option-row input[type=radio] {
    accent-color: #68c3ff;
    width: 17px;
    height: 17px;
    cursor: pointer;
    flex-shrink: 0;
  }

  .cq-option-input {
    flex: 1;
    padding: 9px 0;
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(255,255,255,0.12);
    color: #eaf1fc;
    font-size: 14px;
    outline: none;
    font-family: inherit;
    transition: border-color 0.2s;
  }
  .cq-option-input:focus { border-bottom-color: #68c3ff; }
  .cq-option-input::placeholder { color: #5a7090; }

  .cq-correct-hint {
    font-size: 11px;
    color: #68c3ff;
    margin: 8px 0 12px;
    opacity: 0.7;
  }

  .btn-add-q {
    width: 100%;
    padding: 13px;
    background: transparent;
    border: 1px dashed rgba(104,195,255,0.25);
    border-radius: 10px;
    color: #68c3ff;
    font-size: 14px;
    cursor: pointer;
    margin-top: 4px;
    transition: all 0.2s;
  }
  .btn-add-q:hover {
    border-color: rgba(104,195,255,0.6);
    background: rgba(104,195,255,0.05);
  }

  .btn-remove {
    padding: 4px 12px;
    background: rgba(248,113,113,0.08);
    border: 1px solid rgba(248,113,113,0.2);
    border-radius: 6px;
    color: #f87171;
    font-size: 12px;
    cursor: pointer;
    transition: background 0.2s;
  }
  .btn-remove:hover { background: rgba(248,113,113,0.18); }

  .cq-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 8px;
  }

  .btn-cancel {
    padding: 12px 24px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    color: #9fb0cb;
    font-size: 15px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: background 0.2s;
  }
  .btn-cancel:hover { background: rgba(255,255,255,0.1); }

  .btn-save {
    padding: 12px 32px;
    background: linear-gradient(90deg, #68c3ff, #4f7fc5);
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
    transition: opacity 0.2s;
  }
  .btn-save:hover { opacity: 0.88; }

  .alert-success {
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 14px;
    margin-bottom: 16px;
    background: rgba(74,222,128,0.1);
    border: 1px solid rgba(74,222,128,0.3);
    color: #4ade80;
  }

  .invalid-msg { font-size: 12px; color: #f87171; margin-top: 4px; }
  .cq-input.is-invalid { border-bottom-color: rgba(248,113,113,0.6); }
</style>

<div class="cq-wrap">

  <div class="cq-header">
    <h1>Create Quiz</h1>
    <p>Add a new quiz for students.</p>
  </div>

  @if(session('success'))
    <div class="alert-success" style="margin-top:16px;">✅ {{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('quiz.store') }}" style="margin-top:16px;">
    @csrf

    @if($errors->any())
      <div style="background:red; color:white; padding:10px; margin-bottom:10px;">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <div class="cq-card">
      <h2>📝 Quiz Details</h2>

      <label class="cq-label">Quiz Title *</label>
      <input type="text" name="title"
        class="cq-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
        placeholder="e.g. Basic PHP Quiz"
        value="{{ old('title') }}" required>
      @error('title')
        <div class="invalid-msg">⚠ {{ $message }}</div>
      @enderror

      <label class="cq-label">Description</label>
      <textarea name="description" class="cq-input"
        placeholder="Short description of what this quiz covers...">{{ old('description') }}</textarea>
    </div>

    <div class="cq-card">
      <h2>❓ Questions</h2>
      <p style="color:#9fb0cb;font-size:13px;margin:-8px 0 16px;">
        Add at least 1 question. Select ● to mark the correct answer for multiple choice.
      </p>

      <div id="questionsContainer">
        <div class="cq-question-card" id="q-0">
          <div class="cq-question-header">
            <span>QUESTION 1</span>
          </div>

          <input type="text" name="questions[0][question_text]"
            class="cq-input" placeholder="Enter your question here..." required>

          <div style="margin-top:10px;">
            <label class="cq-label">Question Type</label>
            <select name="questions[0][type]" class="cq-input">
              <option value="multiple_choice">Multiple Choice</option>
              <option value="identification">Identification</option>
            </select>
          </div>

          <div class="correct-answer-wrap" style="margin-top:10px;">
  <label class="cq-label">Correct Answer</label>
  <input type="text" name="questions[0][correct_answer]"
    class="cq-input" placeholder="Type correct answer here">
</div>

          <div class="cq-correct-hint">● Select the correct answer (for multiple choice)</div>

          <div class="cq-option-row">
            <input type="radio" name="questions[0][correct]" value="0" checked>
            <input type="text" class="cq-option-input" name="questions[0][options][]" placeholder="Option A" required>
          </div>
          <div class="cq-option-row">
            <input type="radio" name="questions[0][correct]" value="1">
            <input type="text" class="cq-option-input" name="questions[0][options][]" placeholder="Option B" required>
          </div>
          <div class="cq-option-row">
            <input type="radio" name="questions[0][correct]" value="2">
            <input type="text" class="cq-option-input" name="questions[0][options][]" placeholder="Option C">
          </div>
          <div class="cq-option-row">
            <input type="radio" name="questions[0][correct]" value="3">
            <input type="text" class="cq-option-input" name="questions[0][options][]" placeholder="Option D">
          </div>
        </div>
      </div>

      <button type="button" class="btn-add-q" onclick="addQuestion()">+ Add Another Question</button>
    </div>

    <div class="cq-actions">
      <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
      <button type="submit" class="btn-save">Save Quiz →</button>
    </div>
  </form>
</div>

<script>
let qCount = 1;

function toggleQuestionType(selectEl) {
  const card = selectEl.closest('.cq-question-card');
  const optionRows = card.querySelectorAll('.cq-option-row');
  const correctHint = card.querySelector('.cq-correct-hint');
  const correctAnswerWrap = card.querySelector('.correct-answer-wrap');

  if (selectEl.value === 'identification') {
    optionRows.forEach(row => row.style.display = 'none');
    if (correctHint) correctHint.style.display = 'none';
    if (correctAnswerWrap) correctAnswerWrap.style.display = 'block';
  } else {
    optionRows.forEach(row => row.style.display = 'flex');
    if (correctHint) correctHint.style.display = 'block';
    if (correctAnswerWrap) correctAnswerWrap.style.display = 'block';
  }
}

function addQuestion() {
  const container = document.getElementById('questionsContainer');
  const div = document.createElement('div');
  div.className = 'cq-question-card';
  div.id = 'q-' + qCount;

  div.innerHTML = `
    <div class="cq-question-header">
      <span>QUESTION ${qCount + 1}</span>
      <button type="button" class="btn-remove" onclick="removeQuestion(${qCount})">✕ Remove</button>
    </div>

    <input type="text" name="questions[${qCount}][question_text]"
      class="cq-input" placeholder="Enter your question here..." required>

    <div style="margin-top:10px;">
      <label class="cq-label">Question Type</label>
      <select name="questions[${qCount}][type]" class="cq-input" onchange="toggleQuestionType(this)">
        <option value="multiple_choice">Multiple Choice</option>
        <option value="identification">Identification</option>
      </select>
    </div>

    <div class="correct-answer-wrap" style="margin-top:10px;">
      <label class="cq-label">Correct Answer</label>
      <input type="text" name="questions[${qCount}][correct_answer]"
        class="cq-input" placeholder="Type correct answer here">
    </div>

    <div class="cq-correct-hint">● Select the correct answer (for multiple choice)</div>

    <div class="cq-option-row">
      <input type="radio" name="questions[${qCount}][correct]" value="0" checked>
      <input type="text" class="cq-option-input" name="questions[${qCount}][options][]" placeholder="Option A" required>
    </div>
    <div class="cq-option-row">
      <input type="radio" name="questions[${qCount}][correct]" value="1">
      <input type="text" class="cq-option-input" name="questions[${qCount}][options][]" placeholder="Option B" required>
    </div>
    <div class="cq-option-row">
      <input type="radio" name="questions[${qCount}][correct]" value="2">
      <input type="text" class="cq-option-input" name="questions[${qCount}][options][]" placeholder="Option C">
    </div>
    <div class="cq-option-row">
      <input type="radio" name="questions[${qCount}][correct]" value="3">
      <input type="text" class="cq-option-input" name="questions[${qCount}][options][]" placeholder="Option D">
    </div>
  `;

  container.appendChild(div);
  qCount++;
}

function removeQuestion(id) {
  const el = document.getElementById('q-' + id);
  if (el) el.remove();
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('select[name$="[type]"]').forEach(select => {
    select.addEventListener('change', function () {
      toggleQuestionType(this);
    });
    toggleQuestionType(select);
  });
});
</script>


@endsection