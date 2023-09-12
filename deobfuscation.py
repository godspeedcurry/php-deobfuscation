import os,click
def deobfuse(target_path, output_path):
    print(f'php deobfuscation.php {target_path}.php {output_path}.php')
    os.system(f'php deobfuscation.php {target_path}.php {output_path}.php')
    return output_path

@click.command()
@click.option('-t', '--times',default=1, help='Number of times to deobfuse.')
def main(times):
    target_path = './example5/exp'
    output_path = './example5/output'
    for i in range(times):
        deobfuse(target_path, f"{output_path}_{i}")
        target_path = f"{output_path}_{i}"

if __name__ == "__main__":
    main()    
