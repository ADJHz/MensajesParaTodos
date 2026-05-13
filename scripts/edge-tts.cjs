#!/usr/bin/env node
/**
 * Microsoft Edge Read-Aloud Neural TTS — wrapper para Laravel.
 *
 * Uso:
 *   node scripts/edge-tts.cjs --text "Hola mundo" --voice "es-MX-DaliaNeural" --output "ruta.mp3"
 *
 * Opciones:
 *   --text   <string>   Texto a sintetizar (obligatorio)
 *   --voice  <string>   Voz Microsoft Neural (default: es-MX-DaliaNeural)
 *   --output <ruta>     Archivo MP3 a generar (obligatorio)
 *   --rate   <pct>      -50 a +50 (default: -5, ligeramente más lento = más natural)
 *   --pitch  <pct>      -50 a +50 (default: 0)
 *   --volume <pct>      -50 a +50 (default: 0)
 *
 * Voces recomendadas (es-MX y es-419 — femeninas dulces):
 *   es-MX-DaliaNeural    (mujer, cálida, mexicana) ★★★ recomendada para niñas
 *   es-MX-CarlotaNeural  (mujer, juvenil)
 *   es-MX-LarissaNeural  (mujer, suave)
 *   es-MX-RenataNeural   (mujer, expresiva)
 *   es-MX-NuriaNeural    (mujer, elegante)
 *   es-MX-MarinaNeural   (mujer, profesional)
 *   es-MX-JorgeNeural    (hombre, cálido)
 *   es-MX-LibertoNeural  (hombre, expresivo)
 *   es-MX-PelayoNeural   (hombre, amigable)
 *   es-US-PalomaNeural   (mujer latina US)
 *   es-US-AlonsoNeural   (hombre latino US)
 */
const fs = require('fs');
const path = require('path');
const { MsEdgeTTS, OUTPUT_FORMAT } = require('msedge-tts');

function parseArgs(argv) {
    const out = {};
    for (let i = 2; i < argv.length; i++) {
        const a = argv[i];
        if (a.startsWith('--')) {
            const key = a.slice(2);
            const val = argv[i + 1];
            out[key] = val;
            i++;
        }
    }
    return out;
}

(async () => {
    try {
        const args = parseArgs(process.argv);
        const text   = args.text;
        const voice  = args.voice  || 'es-MX-DaliaNeural';
        const output = args.output;
        const rate   = parseInt(args.rate ?? '-5', 10);
        const pitch  = parseInt(args.pitch ?? '0', 10);
        const volume = parseInt(args.volume ?? '0', 10);

        if (!text)   throw new Error('Falta --text');
        if (!output) throw new Error('Falta --output');

        const tts = new MsEdgeTTS();
        await tts.setMetadata(voice, OUTPUT_FORMAT.AUDIO_24KHZ_96KBITRATE_MONO_MP3);

        // Asegurar carpeta destino
        fs.mkdirSync(path.dirname(output), { recursive: true });

        // toStream() devuelve { audioStream, subtitle } — escribimos manualmente al archivo final
        const { audioStream } = tts.toStream(text, {
            rate:   `${rate >= 0 ? '+' : ''}${rate}%`,
            pitch:  `${pitch >= 0 ? '+' : ''}${pitch}Hz`,
            volume: `${volume >= 0 ? '+' : ''}${volume}%`,
        });

        await new Promise((resolve, reject) => {
            const chunks = [];
            audioStream.on('data', c => chunks.push(c));
            audioStream.on('end', () => {
                try {
                    fs.writeFileSync(output, Buffer.concat(chunks));
                    resolve();
                } catch (e) { reject(e); }
            });
            audioStream.on('error', reject);
        });

        if (!fs.existsSync(output) || fs.statSync(output).size < 100) {
            throw new Error('Archivo generado vacío o no existe');
        }

        process.stdout.write(JSON.stringify({ ok: true, output, voice, bytes: fs.statSync(output).size }));
        process.exit(0);
    } catch (err) {
        process.stderr.write(JSON.stringify({ ok: false, error: String(err && err.message || err) }));
        process.exit(1);
    }
})();
