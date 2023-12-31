var categoriaAtual = 'Crianca'; // Categoria inicial
var estadoTimelines = {}; // Armazena o estado de exibição das timelines

function mostrarTimeline(categoria) {
  // Esconde a timeline da categoria atual
  var timelineAtual = document.getElementById('timeline' + categoriaAtual + 'Content');
  if (timelineAtual) {
	estadoTimelines[categoriaAtual] = timelineAtual.style.display;
	timelineAtual.style.display = 'none';
  }

  // Mostra a timeline correspondente à nova categoria
  var novaTimeline = document.getElementById('timeline' + categoria + 'Content');
  if (novaTimeline) {
	novaTimeline.style.display = estadoTimelines[categoria] || 'block';
	categoriaAtual = categoria; // Atualiza a categoria atual
  } else {
	console.error('Timeline não encontrada para a categoria:', categoria);
  }
}

function mostrarTimeline(opcao) {
	// Esconde todas as timelines
	document.querySelectorAll('.timeline-content').forEach(function(timeline) {
		timeline.style.display = 'none';
	});

	// Mostra a timeline correspondente à opção selecionada
	document.getElementById('timeline' + opcao + 'Content').style.display = 'block';
}