@props(['value' => '', 'index' => 'new'])

<div class="mb-4 telefone-item">
    <label for="telefones[{{ $index }}]" class="block text-sm font-medium text-gray-700">Telefone</label>
    <input 
        type="text" 
        name="telefones[{{ $index }}]" 
        id="telefones_{{ $index }}" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm telefone-input" 
        value="{{ $value }}" 
        placeholder="(XX) XXXXX-XXXX" 
        onblur="validarCampoTelefone(this)"
    >
    <span class="text-red-500 text-sm telefone-erro" style="display: none;">Número de telefone inválido.</span>
    <button type="button" class="remove-telefone text-red-500 hover:text-red-700 mt-1">Remover</button>
</div>
