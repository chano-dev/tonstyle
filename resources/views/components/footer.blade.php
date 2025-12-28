{{-- Footer do Site --}}
<footer class="bg-gray-900 text-white mt-16">
    {{-- Main Footer --}}
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            {{-- About --}}
            <div>
                <h3 class="text-xl font-bold mb-4">
                    Teu<span class="text-orange-500">Estilo</span>
                </h3>
                <p class="text-gray-400 text-sm">
                    A tua loja de moda em Angola. Encontra as melhores peças para expressares o teu estilo único.
                </p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-orange-500">📘</a>
                    <a href="#" class="text-gray-400 hover:text-orange-500">📷</a>
                    <a href="#" class="text-gray-400 hover:text-orange-500">💬</a>
                </div>
            </div>
            
            {{-- Links --}}
            <div>
                <h4 class="font-semibold mb-4">Categorias</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('segments.show', 'mulher') }}" class="hover:text-orange-500">Mulher</a></li>
                    <li><a href="{{ route('segments.show', 'homem') }}" class="hover:text-orange-500">Homem</a></li>
                    <li><a href="{{ route('segments.show', 'crianca') }}" class="hover:text-orange-500">Criança</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-orange-500">Serviços</a></li>
                </ul>
            </div>
            
            {{-- Help --}}
            <div>
                <h4 class="font-semibold mb-4">Ajuda</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-orange-500">Como Comprar</a></li>
                    <li><a href="#" class="hover:text-orange-500">Entregas</a></li>
                    <li><a href="#" class="hover:text-orange-500">Trocas e Devoluções</a></li>
                    <li><a href="#" class="hover:text-orange-500">Contacto</a></li>
                </ul>
            </div>
            
            {{-- Contact --}}
            <div>
                <h4 class="font-semibold mb-4">Contacto</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>📞 +244 928 496 036</li>
                    <li>📧 info@teuestilo.ao</li>
                    <li>📍 Luanda, Angola</li>
                </ul>
                <a 
                    href="https://wa.me/244928496036" 
                    target="_blank"
                    class="inline-block mt-4 bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600"
                >
                    💬 WhatsApp
                </a>
            </div>
        </div>
    </div>
    
    {{-- Bottom Footer --}}
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Teu Estilo. Todos os direitos reservados.</p>
                <div class="flex space-x-4 mt-2 md:mt-0">
                    <a href="#" class="hover:text-orange-500">Termos de Uso</a>
                    <a href="#" class="hover:text-orange-500">Privacidade</a>
                </div>
            </div>
        </div>
    </div>
</footer>