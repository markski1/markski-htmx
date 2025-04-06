Stages of execution
April 5, 2025
Making the most out of your silicon one step at a time.

---

From outside the heart of the machine, we usually think of instructions as being the finest grain of an operation. From the perspective of a programmer, this is perfectly valid, and most of the time in fact a lot finer than you should ever need to go. When we put on the computer scientist caps, however, we can go a little deeper still.

## The finer grain

I say 'finer' and not 'finest' because I am staying outside of the hardware implementation details. I said computer *scientist* cap, not engineer, after all.

If we stick to theory, and simpler RISC architectures, it ***could*** be summed up to 5 main steps:

- Fetch: An instruction is fetched from memory.
- Decode: The instruction is decoded, which is to say, we figure out what instruction the code represents, and what operands are required (such as registries), and fetch those too.
- Execute: Whichever operation(s) the instruction necessitates are performed. Could be moving data around, or perhaps something for the ALU, or anything else.
- Access memory: If needed, perform any changes to memory.
- Write back: Also if needed (for example, if this is an ALU operation or loading something from memory) write the result to a register.

As we head into practice, however, things hardly stay this simple, and we enter the realm of the eldritch when it comes to x86.

The exact number varies from vendor to model, but modern CPU's are believed to have north of 20 stages. For the purpose of this post, we'll stick to the ideal five above.

---

***From this point onwards, assume a single core, single-threaded CPU, of a non-specific RISC architecture, with the "ideal" pipeline stated above.***

---
## Making the most of it

Each cycle of the CPU advances an instruction by one step. Between fetching, decoding, executing, a memory access and a write back, we find ourselves at 5 cycles per instruction. This sounds terrible, if you consider that modern CPU's measure their efficiency at *Instructions per Cycle* rather than *Cycles per Instruction*. What are we missing?

Well, we can consider that different parts of the chip are used for different stages of execution! A single stage doesn't keep the whole chip in a 'busy' state. So, executing a single instruction at once means, at any given time, the other 4 stages are unused.

### Enter the pipeline

Once an instruction is fetched, and a cycle goes past, this instruction moves on to the next step. We can bring the next instruction to the fetching stage, then, and then when this one decodes, fetch the next one, while the first one executes...

| Fetch   | Decode  | Execute | Memory | Write Back |
|:--------|---------|---------|--------|------------|
| Instr 1 |         |         |        |            |
| Instr 2 | Instr 1 |         |        |            |
| Instr 3 | Instr 2 | Instr 1 |        |            |

Now what happens if *Instr 1* does not require to touch memory? This might vary on the hardware, but generally an instruction can be parked on a stage to not disturb the order. Provided no other 